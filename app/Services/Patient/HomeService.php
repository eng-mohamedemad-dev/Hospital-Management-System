<?php

namespace App\Services\Patient;
use App\Interfaces\Patient\HomeInterface;
use App\Models\Doctor;
use App\Models\Specialist;
use App\Models\SearchLog;
class HomeService implements HomeInterface
{
    private $patient;
    public function __construct()
    {
        $this->patient = auth('patient')->user();
    }
    public function getDoctors()
    {
        // return highest rated doctors
        return Doctor::with('specialist', 'address')->orderBy('reviews_avg', 'desc')->get();
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
        $name = $data['name'] ?? '';
        $doctors = Doctor::where('specialist_id', $specialist)
            ->whereBetween('reviews_avg', [$rating - 0.01, $rating + 0.01])
            ->where('name', 'like', "%$name%")
            ->get();
            $this->createSearchLog($data);
            return $doctors;
    }

    public function getSearchLogs()
    {
        return $this->patient->searchLogs;
    }

    private function createSearchLog($data)
    {
        $searchLog = SearchLog::create([
            'patient_id' => $this->patient->id,
            'specialist_id' => $data['specialist_id'],
            'rating' => $data['rating'],
            'name' => $data['name'],
        ]);
        return $searchLog;
    }
}
