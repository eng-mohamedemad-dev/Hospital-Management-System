<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return
        [
            'name' => $this->name ?? '',
            'specialist' => $this->specialist->name,
            'rating' => round($this->reviews_avg, 1),
            'specialist_id' => $this->specialist->name,
            'hospital' => $this->hospital,
            'reviews_count' => $this->reviews_count,
            'image' => $this->image ? asset('storage/'.$this->image) : null,
            'country' => $this->address->country ?? '',
            'state' => $this->address->state ?? '',
            'address' => $this->address->address ?? '',
            'str' => $this->str,
            'experience' => $this->experience,
            'about' => $this->about,
            'email' => $this->email,
        ];
    }
}
