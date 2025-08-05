<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Session;
use App\Models\Tutor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display feedback page
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isTutor()) {
            // Show feedback received by this tutor
            $feedbacks = Feedback::with(['fromUser', 'session.subject'])
                ->where('to_tutor_id', $user->tutor->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            // Show feedback given by this user
            $feedbacks = Feedback::with(['toTutor.user', 'session.subject'])
                ->where('from_user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        // Get completed sessions that can be rated
        $completedSessions = $this->getCompletedSessionsForFeedback($user);

        return view('feedback', compact('feedbacks', 'completedSessions'));
    }

    /**
     * Store feedback for a session
     */
    public function store(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:sessions,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        $user = Auth::user();
        $session = Session::findOrFail($request->session_id);

        // Check if user can provide feedback for this session
        if (!$this->canProvideFeedback($user, $session)) {
            return redirect()->back()->with('error', __('feedback.errors.not_authorized'));
        }

        // Check if feedback already exists
        $existingFeedback = Feedback::where('session_id', $request->session_id)
            ->where('from_user_id', $user->id)
            ->first();

        if ($existingFeedback) {
            return redirect()->back()->with('error', __('feedback.errors.already_provided'));
        }

        try {
            DB::beginTransaction();

            $feedback = Feedback::create([
                'session_id' => $request->session_id,
                'from_user_id' => $user->id,
                'to_tutor_id' => $session->tutor_id,
                'rating' => $request->rating,
                'comment' => $request->comment
            ]);

            // Update tutor's average rating
            $this->updateTutorRating($session->tutor_id);

            // Notify tutor about new feedback
            $this->createNotification(
                $session->tutor->user_id,
                'feedback_received',
                __('notifications.feedback_received.title'),
                __('notifications.feedback_received.message', ['rating' => $request->rating]),
                route('feedback')
            );

            DB::commit();

            return redirect()->back()->with('success', __('feedback.success.feedback_submitted'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', __('feedback.errors.submission_failed'));
        }
    }

    /**
     * Update feedback
     */
    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        $user = Auth::user();

        // Check if user can update this feedback
        if ($feedback->from_user_id !== $user->id) {
            return redirect()->back()->with('error', __('feedback.errors.not_authorized'));
        }

        try {
            DB::beginTransaction();

            $feedback->update([
                'rating' => $request->rating,
                'comment' => $request->comment
            ]);

            // Update tutor's average rating
            $this->updateTutorRating($feedback->to_tutor_id);

            DB::commit();

            return redirect()->back()->with('success', __('feedback.success.feedback_updated'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', __('feedback.errors.update_failed'));
        }
    }

    /**
     * Delete feedback
     */
    public function destroy(Feedback $feedback)
    {
        $user = Auth::user();

        // Check if user can delete this feedback
        if ($feedback->from_user_id !== $user->id) {
            return redirect()->back()->with('error', __('feedback.errors.not_authorized'));
        }

        try {
            DB::beginTransaction();

            $tutorId = $feedback->to_tutor_id;
            $feedback->delete();

            // Update tutor's average rating
            $this->updateTutorRating($tutorId);

            DB::commit();

            return redirect()->back()->with('success', __('feedback.success.feedback_deleted'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', __('feedback.errors.delete_failed'));
        }
    }

    /**
     * Get tutor's feedback and ratings
     */
    public function getTutorFeedback($tutorId)
    {
        $tutor = Tutor::with('user')->findOrFail($tutorId);

        $feedbacks = Feedback::with(['fromUser', 'session.subject'])
            ->where('to_tutor_id', $tutorId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $stats = $this->getTutorFeedbackStats($tutorId);

        return view('tutor-feedback', compact('tutor', 'feedbacks', 'stats'));
    }

    /**
     * Check if user can provide feedback for a session
     */
    private function canProvideFeedback($user, $session)
    {
        // Only students or guardians can provide feedback
        if (!$user->isStudent() && !$user->isGuardian()) {
            return false;
        }

        // Session must be completed
        if ($session->status !== 'completed') {
            return false;
        }

        // User must be the student in the session or guardian of the student
        if ($user->isStudent()) {
            return $session->student_id === $user->student->id;
        }

        if ($user->isGuardian()) {
            // Check if user is guardian of the student in this session
            return $user->guardian->students()->where('student_id', $session->student_id)->exists();
        }

        return false;
    }

    /**
     * Get completed sessions that can receive feedback
     */
    private function getCompletedSessionsForFeedback($user)
    {
        if (!$user->isStudent() && !$user->isGuardian()) {
            return collect();
        }

        $sessionsQuery = Session::with(['tutor.user', 'subject'])
            ->where('status', 'completed');

        if ($user->isStudent()) {
            $sessionsQuery->where('student_id', $user->student->id);
        } elseif ($user->isGuardian()) {
            $studentIds = $user->guardian->students()->pluck('student_id');
            $sessionsQuery->whereIn('student_id', $studentIds);
        }

        // Exclude sessions that already have feedback from this user
        $sessionsQuery->whereNotExists(function ($query) use ($user) {
            $query->select(DB::raw(1))
                ->from('feedback')
                ->whereColumn('feedback.session_id', 'sessions.id')
                ->where('feedback.from_user_id', $user->id);
        });

        return $sessionsQuery->orderBy('date', 'desc')->get();
    }

    /**
     * Update tutor's average rating
     */
    private function updateTutorRating($tutorId)
    {
        $averageRating = Feedback::where('to_tutor_id', $tutorId)->avg('rating');
        $totalFeedbacks = Feedback::where('to_tutor_id', $tutorId)->count();

        Tutor::where('id', $tutorId)->update([
            'rating' => round($averageRating, 2),
            'total_reviews' => $totalFeedbacks
        ]);
    }

    /**
     * Get tutor feedback statistics
     */
    private function getTutorFeedbackStats($tutorId)
    {
        $feedbacks = Feedback::where('to_tutor_id', $tutorId);

        return [
            'total' => $feedbacks->count(),
            'average_rating' => round($feedbacks->avg('rating'), 2),
            'rating_distribution' => [
                5 => $feedbacks->clone()->where('rating', 5)->count(),
                4 => $feedbacks->clone()->where('rating', 4)->count(),
                3 => $feedbacks->clone()->where('rating', 3)->count(),
                2 => $feedbacks->clone()->where('rating', 2)->count(),
                1 => $feedbacks->clone()->where('rating', 1)->count(),
            ]
        ];
    }

    /**
     * Create a notification
     */
    private function createNotification($userId, $type, $title, $message, $actionUrl = null)
    {
        \App\Models\Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'action_url' => $actionUrl,
            'data' => json_encode([])
        ]);
    }
}
