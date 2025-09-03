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
            'specialist' => $this->specialist->name,
            'hospital' => $this->hospital,
            'reviews_count' => $this->reviews_count,
            'image' => $this->image ? asset('storage/'.$this->image) : null,
            'str' => $this->str,
            'experience' => $this->experience,
            'about' => $this->about,
            // 'location' => $this->address->map(function($address){
            //     return [
            //         'address' => $address->address,
            //         'state' => $address->state,
            //         'country' => $address->country,
            //     ];
            // })
        ];
    }
}
