<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuardianStudent extends Model
{
    protected $fillable = ['guardian_id', 'student_id'];

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
