<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    protected $fillable = [
        'name',
        'image',
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
