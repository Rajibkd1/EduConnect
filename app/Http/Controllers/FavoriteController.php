<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Tutor;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display user's favorite tutors
     */
    public function index()
    {
        $user = Auth::user();
        
        $favorites = Favorite::with(['tutor.user', 'tutor.subjects'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('favorites', compact('favorites'));
    }

    /**
     * Toggle favorite status for a tutor
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'tutor_id' => 'required|exists:tutors,id'
        ]);

        $user = Auth::user();
        
        // Only students and guardians can favorite tutors
        if ($user->user_type !== 'student' && $user->user_type !== 'guardian') {
            return response()->json(['error' => 'Only students and guardians can favorite tutors'], 403);
        }

        try {
            $result = Favorite::toggle($user->id, $request->tutor_id);
            
            // Create notification for tutor if favorited
            if ($result['favorited']) {
                $tutor = Tutor::findOrFail($request->tutor_id);
                $this->createNotification(
                    $tutor->user_id,
                    'new_favorite',
                    __('notifications.new_favorite.title'),
                    __('notifications.new_favorite.message', ['user' => $user->name]),
                    route('tutor.show', $tutor->id)
                );
            }

            return response()->json([
                'success' => true,
                'favorited' => $result['favorited'],
                'message' => $result['message']
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update favorite status'], 500);
        }
    }

    /**
     * Remove a tutor from favorites
     */
    public function destroy($tutorId)
    {
        $user = Auth::user();
        
        $favorite = Favorite::where('user_id', $user->id)
            ->where('tutor_id', $tutorId)
            ->first();

        if (!$favorite) {
            return redirect()->back()->with('error', 'Tutor not found in your favorites.');
        }

        $favorite->delete();

        return redirect()->back()->with('success', 'Tutor removed from favorites successfully.');
    }

    /**
     * Check if a tutor is favorited by the current user
     */
    public function checkStatus($tutorId)
    {
        $user = Auth::user();
        
        $isFavorited = Favorite::isFavorited($user->id, $tutorId);

        return response()->json([
            'favorited' => $isFavorited
        ]);
    }

    /**
     * Get user's favorite tutors count
     */
    public function getCount()
    {
        $user = Auth::user();
        
        $count = Favorite::where('user_id', $user->id)->count();

        return response()->json([
            'count' => $count
        ]);
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
