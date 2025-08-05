<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get messages for a session
     */
    public function getSessionMessages($sessionId)
    {
        $session = Session::findOrFail($sessionId);
        $user = Auth::user();

        // Check if user is part of this session
        if (!$this->canAccessSession($user, $session)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messages = Message::with('sender')
            ->where('session_id', $sessionId)
            ->orderBy('sent_at', 'asc')
            ->get();

        return response()->json([
            'messages' => $messages,
            'session' => $session->load(['tutor.user', 'student.user', 'subject'])
        ]);
    }

    /**
     * Send a message in a session
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:sessions,id',
            'message' => 'required|string|max:1000'
        ]);

        $session = Session::findOrFail($request->session_id);
        $user = Auth::user();

        // Check if user is part of this session
        if (!$this->canAccessSession($user, $session)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            $message = Message::create([
                'session_id' => $request->session_id,
                'sender_user_id' => $user->id,
                'message' => $request->message,
                'sent_at' => now()
            ]);

            $message->load('sender');

            // Notify the other participant
            $otherUserId = $user->isTutor() ? $session->student->user_id : $session->tutor->user_id;
            $this->createNotification(
                $otherUserId,
                'new_message',
                __('notifications.new_message.title'),
                __('notifications.new_message.message', ['sender' => $user->name]),
                route('sessions')
            );

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send message'], 500);
        }
    }

    /**
     * Get chat interface for a session
     */
    public function showChat($sessionId)
    {
        $session = Session::with(['tutor.user', 'student.user', 'subject'])->findOrFail($sessionId);
        $user = Auth::user();

        // Check if user is part of this session
        if (!$this->canAccessSession($user, $session)) {
            abort(403, 'Unauthorized');
        }

        return view('chat', compact('session'));
    }

    /**
     * Get all conversations for a user
     */
    public function getConversations()
    {
        $user = Auth::user();
        
        if ($user->isTutor()) {
            $sessions = Session::with(['student.user', 'subject'])
                ->where('tutor_id', $user->tutor->id)
                ->whereHas('messages')
                ->withCount('messages')
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $sessions = Session::with(['tutor.user', 'subject'])
                ->where('student_id', $user->student->id)
                ->whereHas('messages')
                ->withCount('messages')
                ->orderBy('updated_at', 'desc')
                ->get();
        }

        // Add last message to each session
        $sessions->each(function ($session) {
            $session->last_message = $session->messages()
                ->with('sender')
                ->latest('sent_at')
                ->first();
        });

        return view('conversations', compact('sessions'));
    }

    /**
     * Mark messages as read
     */
    public function markAsRead(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:sessions,id'
        ]);

        $session = Session::findOrFail($request->session_id);
        $user = Auth::user();

        // Check if user is part of this session
        if (!$this->canAccessSession($user, $session)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Mark messages as read (this would require adding a read_at field to messages table)
        // For now, we'll just return success
        return response()->json(['success' => true]);
    }

    /**
     * Check if user can access a session's messages
     */
    private function canAccessSession($user, $session)
    {
        if ($user->isTutor()) {
            return $session->tutor_id === $user->tutor->id;
        } elseif ($user->isStudent()) {
            return $session->student_id === $user->student->id;
        } elseif ($user->isGuardian()) {
            // Check if user is guardian of the student in this session
            return $user->guardian->students()->where('student_id', $session->student_id)->exists();
        }

        return false;
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
