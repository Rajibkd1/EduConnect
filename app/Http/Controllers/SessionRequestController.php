<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionRequest;
use App\Models\Tutor;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SessionRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display session requests for the authenticated user
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->isTutor()) {
            // Show requests received by this tutor
            $sessionRequests = SessionRequest::with(['student.user', 'subject'])
                ->where('tutor_id', $user->tutor->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            // Show requests sent by this student
            $sessionRequests = SessionRequest::with(['tutor.user', 'subject'])
                ->where('student_id', $user->student->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        return view('session-requests', compact('sessionRequests'));
    }

    /**
     * Show form to create a new session request
     */
    public function create($tutorId)
    {
        $tutor = Tutor::with(['user', 'subjects'])->findOrFail($tutorId);
        $subjects = $tutor->subjects;

        return view('session-requests.create', compact('tutor', 'subjects'));
    }

    /**
     * Store a new session request
     */
    public function store(Request $request)
    {
        $request->validate([
            'tutor_id' => 'required|exists:tutors,id',
            'subject_id' => 'required|exists:subjects,id',
            'requested_time' => 'required|date|after:now',
            'message' => 'nullable|string|max:500',
            'duration' => 'required|integer|min:30|max:180', // 30 minutes to 3 hours
        ]);

        $user = Auth::user();

        if (!$user->isStudent() && !$user->isGuardian()) {
            return redirect()->back()->with('error', __('session_requests.errors.not_authorized'));
        }

        // Get student ID
        $studentId = $user->isStudent() ? $user->student->id : null;

        if (!$studentId && $user->isGuardian()) {
            // For guardians, we need to handle student selection
            $request->validate([
                'student_id' => 'required|exists:students,id'
            ]);
            $studentId = $request->student_id;
        }

        // Check if there's already a pending request for this tutor and subject
        $existingRequest = SessionRequest::where('student_id', $studentId)
            ->where('tutor_id', $request->tutor_id)
            ->where('subject_id', $request->subject_id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return redirect()->back()->with('error', __('session_requests.errors.duplicate_request'));
        }

        try {
            DB::beginTransaction();

            $sessionRequest = SessionRequest::create([
                'student_id' => $studentId,
                'tutor_id' => $request->tutor_id,
                'subject_id' => $request->subject_id,
                'requested_time' => $request->requested_time,
                'duration' => $request->duration,
                'message' => $request->message,
                'status' => 'pending'
            ]);

            // Create notification for tutor
            $this->createNotification(
                $request->tutor_id,
                'session_request',
                __('notifications.session_request.title'),
                __('notifications.session_request.message', ['student' => $user->name]),
                route('session-requests')
            );

            DB::commit();

            return redirect()->route('session-requests')
                ->with('success', __('session_requests.success.request_sent'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', __('session_requests.errors.request_failed'));
        }
    }

    /**
     * Update session request status (approve/reject)
     */
    public function updateStatus(Request $request, SessionRequest $sessionRequest)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'response_message' => 'nullable|string|max:500'
        ]);

        $user = Auth::user();

        // Only the tutor can update the status
        if (!$user->isTutor() || $sessionRequest->tutor_id !== $user->tutor->id) {
            return redirect()->back()->with('error', __('session_requests.errors.not_authorized'));
        }

        try {
            DB::beginTransaction();

            $sessionRequest->update([
                'status' => $request->status,
                'response_message' => $request->response_message,
                'responded_at' => now()
            ]);

            // If approved, create a session
            if ($request->status === 'approved') {
                $session = \App\Models\Session::create([
                    'tutor_id' => $sessionRequest->tutor_id,
                    'student_id' => $sessionRequest->student_id,
                    'subject_id' => $sessionRequest->subject_id,
                    'date' => \Carbon\Carbon::parse($sessionRequest->requested_time)->toDateString(),
                    'time' => \Carbon\Carbon::parse($sessionRequest->requested_time)->toTimeString(),
                    'duration' => $sessionRequest->duration,
                    'status' => 'confirmed'
                ]);

                // Notify student about approval
                $this->createNotification(
                    $sessionRequest->student->user_id,
                    'session_approved',
                    __('notifications.session_approved.title'),
                    __('notifications.session_approved.message'),
                    route('sessions')
                );
            } else {
                // Notify student about rejection
                $this->createNotification(
                    $sessionRequest->student->user_id,
                    'session_rejected',
                    __('notifications.session_rejected.title'),
                    __('notifications.session_rejected.message'),
                    route('session-requests')
                );
            }

            DB::commit();

            $message = $request->status === 'approved'
                ? __('session_requests.success.request_approved')
                : __('session_requests.success.request_rejected');

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', __('session_requests.errors.update_failed'));
        }
    }

    /**
     * Cancel a session request
     */
    public function cancel(SessionRequest $sessionRequest)
    {
        $user = Auth::user();

        // Only the student who made the request can cancel it
        if (!$user->isStudent() || $sessionRequest->student->user_id !== $user->id) {
            return redirect()->back()->with('error', __('session_requests.errors.not_authorized'));
        }

        if ($sessionRequest->status !== 'pending') {
            return redirect()->back()->with('error', __('session_requests.errors.cannot_cancel'));
        }

        $sessionRequest->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', __('session_requests.success.request_cancelled'));
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
