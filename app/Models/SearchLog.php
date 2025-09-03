<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    protected $fillable = [
        'patient_id',
        'specialist_id',
        'rating',
        'name',
    ];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
