<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['session_id', 'sender_user_id', 'message', 'sent_at'];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_user_id');
    }
}
