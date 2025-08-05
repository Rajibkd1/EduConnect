<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\DirectMessage;
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
     * Show direct messaging interface with a user
     */
    public function showDirectChat($userId)
    {
        $user = Auth::user();
        $otherUser = User::findOrFail($userId);

        // Check if users can message each other (student-tutor relationship)
        if (!$this->canMessageUser($user, $otherUser)) {
            abort(403, 'You cannot message this user.');
        }

        return view('direct-chat', compact('otherUser'));
    }

    /**
     * Get direct messages between two users
     */
    public function getDirectMessages($userId)
    {
        $user = Auth::user();
        $otherUser = User::findOrFail($userId);

        if (!$this->canMessageUser($user, $otherUser)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messages = DirectMessage::betweenUsers($user->id, $userId)
            ->with(['sender', 'receiver'])
            ->orderBy('sent_at', 'asc')
            ->get();

        // Mark messages as read
        DirectMessage::where('sender_user_id', $userId)
            ->where('receiver_user_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'messages' => $messages,
            'other_user' => $otherUser
        ]);
    }

    /**
     * Send a direct message
     */
    public function sendDirectMessage(Request $request)
    {
        $request->validate([
            'receiver_user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000'
        ]);

        $user = Auth::user();
        $receiverUser = User::findOrFail($request->receiver_user_id);

        if (!$this->canMessageUser($user, $receiverUser)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            $message = DirectMessage::create([
                'sender_user_id' => $user->id,
                'receiver_user_id' => $request->receiver_user_id,
                'message' => $request->message,
                'sent_at' => now()
            ]);

            $message->load(['sender', 'receiver']);

            // Create notification for receiver
            $this->createNotification(
                $request->receiver_user_id,
                'direct_message',
                __('notifications.direct_message.title'),
                __('notifications.direct_message.message', ['sender' => $user->name]),
                route('direct-chat', $user->id)
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
     * Get all direct conversations for a user
     */
    public function getDirectConversations()
    {
        $user = Auth::user();

        // Get all users that have exchanged messages with current user
        $conversationUserIds = DirectMessage::where('sender_user_id', $user->id)
            ->orWhere('receiver_user_id', $user->id)
            ->select('sender_user_id', 'receiver_user_id')
            ->get()
            ->flatMap(function ($message) use ($user) {
                return [$message->sender_user_id, $message->receiver_user_id];
            })
            ->unique()
            ->filter(function ($id) use ($user) {
                return $id !== $user->id;
            });

        $conversations = User::whereIn('id', $conversationUserIds)
            ->with(['tutor', 'student'])
            ->get()
            ->map(function ($conversationUser) use ($user) {
                // Get last message between users
                $lastMessage = DirectMessage::betweenUsers($user->id, $conversationUser->id)
                    ->with('sender')
                    ->latest('sent_at')
                    ->first();

                // Get unread count
                $unreadCount = DirectMessage::where('sender_user_id', $conversationUser->id)
                    ->where('receiver_user_id', $user->id)
                    ->whereNull('read_at')
                    ->count();

                $conversationUser->last_message = $lastMessage;
                $conversationUser->unread_count = $unreadCount;

                return $conversationUser;
            })
            ->sortByDesc(function ($conversation) {
                return $conversation->last_message ? $conversation->last_message->sent_at : null;
            });

        return view('direct-conversations', compact('conversations'));
    }

    /**
     * Check if a user can message another user
     */
    private function canMessageUser($user, $otherUser)
    {
        // Students can message tutors and vice versa
        if (($user->user_type === 'student' && $otherUser->user_type === 'tutor') ||
            ($user->user_type === 'tutor' && $otherUser->user_type === 'student')
        ) {
            return true;
        }

        // Guardians can message tutors
        if ($user->user_type === 'guardian' && $otherUser->user_type === 'tutor') {
            return true;
        }

        return false;
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
            $otherUserId = $user->user_type === 'tutor' ? $session->student->user_id : $session->tutor->user_id;
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

        if ($user->user_type === 'tutor') {
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
        if ($user->user_type === 'tutor') {
            return $session->tutor_id === $user->tutor->id;
        } elseif ($user->user_type === 'student') {
            return $session->student_id === $user->student->id;
        } elseif ($user->user_type === 'guardian') {
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
