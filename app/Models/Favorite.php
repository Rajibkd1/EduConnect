<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tutor_id',
    ];

    /**
     * Get the user who favorited the tutor
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the favorited tutor
     */
    public function tutor(): BelongsTo
    {
        return $this->belongsTo(Tutor::class);
    }

    /**
     * Check if a user has favorited a specific tutor
     */
    public static function isFavorited($userId, $tutorId): bool
    {
        return self::where('user_id', $userId)
            ->where('tutor_id', $tutorId)
            ->exists();
    }

    /**
     * Toggle favorite status for a user and tutor
     */
    public static function toggle($userId, $tutorId): array
    {
        $favorite = self::where('user_id', $userId)
            ->where('tutor_id', $tutorId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return ['favorited' => false, 'message' => 'Tutor removed from favorites'];
        } else {
            self::create([
                'user_id' => $userId,
                'tutor_id' => $tutorId,
            ]);
            return ['favorited' => true, 'message' => 'Tutor added to favorites'];
        }
    }
}
