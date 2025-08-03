<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['session_id', 'from_user_id', 'to_tutor_id', 'rating', 'comment', 'created_at'];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toTutor()
    {
        return $this->belongsTo(Tutor::class, 'to_tutor_id');
    }
}
