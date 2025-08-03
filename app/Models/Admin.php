<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = ['id', 'admin_level', 'note'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
