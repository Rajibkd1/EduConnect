<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Tutor;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SessionController extends Controller
{
    // Middleware is now handled in routes/web.php, so we don't need constructor middleware

    /**
     * Display sessions for the authenticated user
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $status = $request->get('status', 'all');

        if ($user->isTutor()) {
            $sessionsQuery = Session::with(['student.user', 'subject'])
                ->where('tutor_id', $user->tutor->id);
        } else {
            $sessionsQuery = Session::with(['tutor.user', 'subject'])
                ->where('student_id', $user->student->id);
        }

        // Filter by status if specified
        if ($status !== 'all') {
            $sessionsQuery->where('status', $status);
        }

        $sessions = $sessionsQuery->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(10);

        // Get session statistics
        $stats = $this->getSessionStats($user);

        return view('sessions', compact('sessions', 'stats', 'status'));
    }

    /**
     * Show form to create a new session (for tutors)
     */
    public function create()
    {
        $user = Auth::user();

        if (!$user->isTutor()) {
            return redirect()->route('dashboard')->with('error', __('sessions.errors.tutor_only'));
        }

        $subjects = $user->tutor->subjects;
        $students = Student::with('user')->get(); // In real app, this should be filtered by tutor's students

        return view('create-sessions', compact('subjects', 'students'));
    }

    /**
     * Store a new session
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:30|max:180',
            'notes' => 'nullable|string|max:1000'
        ]);

        $user = Auth::user();

        if (!$user->isTutor()) {
            return redirect()->back()->with('error', __('sessions.errors.tutor_only'));
        }

        // Check for time conflicts
        $conflictingSession = Session::where('tutor_id', $user->tutor->id)
            ->where('date', $request->date)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($request) {
                $startTime = Carbon::createFromFormat('H:i', $request->time);
                $endTime = $startTime->copy()->addMinutes($request->duration);

                $query->whereBetween('time', [$startTime->format('H:i:s'), $endTime->format('H:i:s')])
                    ->orWhere(function ($q) use ($startTime, $endTime) {
                        $q->where('time', '<=', $startTime->format('H:i:s'))
                            ->whereRaw('ADDTIME(time, SEC_TO_TIME(duration * 60)) > ?', [$startTime->format('H:i:s')]);
                    });
            })
            ->first();

        if ($conflictingSession) {
            return redirect()->back()->with('error', __('sessions.errors.time_conflict'));
        }

        try {
            DB::beginTransaction();

            $session = Session::create([
                'tutor_id' => $user->tutor->id,
                'student_id' => $request->student_id,
                'subject_id' => $request->subject_id,
                'date' => $request->date,
                'time' => $request->time,
                'duration' => $request->duration,
                'status' => 'confirmed',
                'notes' => $request->notes
            ]);

            // Notify student about new session
            $student = Student::with('user')->find($request->student_id);
            $this->createNotification(
                $student->user_id,
                'session_created',
                __('notifications.session_created.title'),
                __('notifications.session_created.message', ['tutor' => $user->name]),
                route('sessions')
            );

            DB::commit();

            return redirect()->route('sessions')
                ->with('success', __('sessions.success.session_created'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', __('sessions.errors.creation_failed'));
        }
    }

    /**
     * Update session status
     */
    public function updateStatus(Request $request, Session $session)
    {
        $request->validate([
            'status' => 'required|in:confirmed,completed,cancelled',
            'notes' => 'nullable|string|max:1000'
        ]);

        $user = Auth::user();

        // Check authorization
        if (!$user->isTutor() || $session->tutor_id !== $user->tutor->id) {
            return redirect()->back()->with('error', __('sessions.errors.not_authorized'));
        }

        try {
            $session->update([
                'status' => $request->status,
                'notes' => $request->notes
            ]);

            // Notify student about status change
            $this->createNotification(
                $session->student->user_id,
                'session_status_updated',
                __('notifications.session_status_updated.title'),
                __('notifications.session_status_updated.message', [
                    'status' => ucfirst($request->status)
                ]),
                route('sessions')
            );

            return redirect()->back()->with('success', __('sessions.success.status_updated'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('sessions.errors.update_failed'));
        }
    }

    /**
     * Cancel a session
     */
    public function cancel(Session $session)
    {
        $user = Auth::user();

        // Both tutor and student can cancel
        $canCancel = ($user->isTutor() && $session->tutor_id === $user->tutor->id) ||
            ($user->isStudent() && $session->student_id === $user->student->id);

        if (!$canCancel) {
            return redirect()->back()->with('error', __('sessions.errors.not_authorized'));
        }

        if ($session->status === 'completed') {
            return redirect()->back()->with('error', __('sessions.errors.cannot_cancel_completed'));
        }

        try {
            $session->update(['status' => 'cancelled']);

            // Notify the other party
            $notifyUserId = $user->isTutor() ? $session->student->user_id : $session->tutor->user_id;
            $this->createNotification(
                $notifyUserId,
                'session_cancelled',
                __('notifications.session_cancelled.title'),
                __('notifications.session_cancelled.message', ['user' => $user->name]),
                route('sessions')
            );

            return redirect()->back()->with('success', __('sessions.success.session_cancelled'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('sessions.errors.cancel_failed'));
        }
    }

    /**
     * Get session statistics for user
     */
    private function getSessionStats($user)
    {
        if ($user->isTutor()) {
            $baseQuery = Session::where('tutor_id', $user->tutor->id);
        } else {
            $baseQuery = Session::where('student_id', $user->student->id);
        }

        return [
            'upcoming' => $baseQuery->clone()->where('status', 'confirmed')
                ->where(function ($query) {
                    $query->where('date', '>', now()->toDateString())
                        ->orWhere(function ($q) {
                            $q->where('date', now()->toDateString())
                                ->where('time', '>', now()->toTimeString());
                        });
                })->count(),
            'completed' => $baseQuery->clone()->where('status', 'completed')->count(),
            'pending' => $baseQuery->clone()->where('status', 'pending')->count(),
            'cancelled' => $baseQuery->clone()->where('status', 'cancelled')->count(),
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
