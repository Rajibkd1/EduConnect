<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['tutor_id', 'student_id', 'subject_id', 'status', 'date', 'time', 'duration'];

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

    public function messages()
    {
        return $this->hasMany(Message::class, 'session_id');
    }
}
