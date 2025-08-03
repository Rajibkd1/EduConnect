<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = [
        'user_id', 
        'profile_image', 
        'child_name', 
        'child_birthdate', 
        'current_class', 
        'school_college_name', 
        'address', 
        'phone_number'
    ];

    protected $casts = [
        'child_birthdate' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'guardian_students');
    }
}
