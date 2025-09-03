<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'doctor_id',
        'state',
        'address',
        'country',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
