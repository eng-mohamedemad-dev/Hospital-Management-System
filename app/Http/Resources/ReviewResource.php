<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'patient' => $this->patient->name,
            'patient_image' => $this->image ?asset('storage/'.$this->patient->image):null,
            'is_patient' => $this->patient_id === auth()->id(),
        ];
    }
}
