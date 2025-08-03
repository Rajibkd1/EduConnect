<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $fillable = ['id', 'dev_area', 'note'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
