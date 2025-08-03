<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionRequest extends Model
{
    protected $fillable = ['student_id', 'tutor_id', 'subject_id', 'requested_time', 'status', 'message'];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
