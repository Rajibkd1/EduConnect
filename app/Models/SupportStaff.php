<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportStaff extends Model
{
    protected $fillable = ['id', 'support_role', 'note'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
