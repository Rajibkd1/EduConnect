<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'description'];

    public function tutors()
    {
        return $this->belongsToMany(Tutor::class, 'tutor_subjects');
    }
}
