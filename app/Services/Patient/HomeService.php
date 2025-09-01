<?php

namespace App\Services\Patient;
use App\Interfaces\Patient\HomeInterface;
use App\Models\Doctor;
use App\Models\Specialist;

class HomeService implements HomeInterface
{
    public function getDoctors()
    {
        // return highest rated doctors
        return Doctor::with('specialist')->orderBy('reviews_avg', 'desc')->get();
    }

    public function getSpecialists()
    {
        return Specialist::orderBy('name', 'asc')->get();
    }

    public function searchDoctors($data)
    {
        // search by specialist by default genral and search by rating 
        $specialist = $data['specialist_id'] ?? 1;
        $rating = $data['rating'] ?? 5.00;
        return Doctor::where([
            'specialist_id' => $specialist,
            'reviews_avg' => $rating,
        ])->get();
    }
}
