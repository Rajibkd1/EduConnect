<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'user_id');
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class, 'user_id');
    }

    public function guardian()
    {
        return $this->hasOne(Guardian::class, 'user_id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }

    public function supportStaff()
    {
        return $this->hasOne(SupportStaff::class, 'user_id');
    }

    public function developer()
    {
        return $this->hasOne(Developer::class, 'user_id');
    }
}
