<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable = [
        'user_id', 
        'name', 
        'profile_image', 
        'phone_number', 
        'university_name', 
        'university_id', 
        'department', 
        'semester', 
        'address', 
        'university_id_image', 
        'bio', 
        'qualifications', 
        'experience_years', 
        'rating',
        'total_reviews'
    ];

    protected $casts = [
        'rating' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'tutor_subjects');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'tutor_id');
    }
}
