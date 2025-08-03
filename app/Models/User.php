<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'user_type'
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'id');
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class, 'id');
    }

    public function guardian()
    {
        return $this->hasOne(Guardian::class, 'id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'id');
    }

    public function supportStaff()
    {
        return $this->hasOne(SupportStaff::class, 'id');
    }

    public function developer()
    {
        return $this->hasOne(Developer::class, 'id');
    }
}
