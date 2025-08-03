<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable = ['id', 'bio', 'qualifications', 'experience_years', 'rating'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
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
