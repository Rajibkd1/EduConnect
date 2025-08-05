<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all notifications for the authenticated user
     */
    public function index()
    {
        $user = Auth::user();

        $notifications = Notification::forUser($user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Get unread notifications count
     */
    public function getUnreadCount()
    {
        $user = Auth::user();

        $count = Notification::forUser($user->id)
            ->unread()
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Get recent notifications for dropdown
     */
    public function getRecent()
    {
        $user = Auth::user();

        $notifications = Notification::forUser($user->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json(['notifications' => $notifications]);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead(Notification $notification)
    {
        $user = Auth::user();

        // Check if notification belongs to the user
        if ($notification->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        $user = Auth::user();

        Notification::forUser($user->id)
            ->unread()
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    /**
     * Delete a notification
     */
    public function destroy(Notification $notification)
    {
        $user = Auth::user();

        // Check if notification belongs to the user
        if ($notification->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $notification->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Delete all read notifications
     */
    public function clearRead()
    {
        $user = Auth::user();

        Notification::forUser($user->id)
            ->whereNotNull('read_at')
            ->delete();

        return response()->json(['success' => true]);
    }
}
