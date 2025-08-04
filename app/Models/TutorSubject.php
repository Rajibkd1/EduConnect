<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorSubject extends Model
{
    protected $fillable = ['tutor_id', 'subject_id'];

    // Enable timestamps for this pivot table
    public $timestamps = true;

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
