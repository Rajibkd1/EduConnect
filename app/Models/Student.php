<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['id', 'educational_level'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'student_id');
    }
}
