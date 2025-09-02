<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return
        [
            'id'        => $this->id,
            'day'       => $this->day,
            'time_from' => $this->time_from,
            'time_to'   => $this->time_to,
            'doctor_id' => $this->doctor_id,
        ];
    }
}
