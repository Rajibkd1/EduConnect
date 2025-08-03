<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'educational_level',
        'profile_image',
        'birth_date',
        'current_study_class',
        'school_college_name',
        'address',
        'phone_number'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'student_id');
    }
}
