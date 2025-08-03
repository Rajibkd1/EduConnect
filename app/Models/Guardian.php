<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = ['id', 'phone', 'address'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'guardian_students');
    }
}
