<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'day' => $this->day,
            'time_from' => substr($this->time_from, 0, 5),
            'time_to' => substr($this->time_to, 0, 5),
        ];
    }
}
