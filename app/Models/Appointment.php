<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'day',
        'doctor_id',
        'time_from',
        'time_to',
    ];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
