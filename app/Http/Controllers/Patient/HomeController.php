<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Patient\HomeService;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\SpecialistResouce;
use App\Http\Resources\SearchLogResource;

class HomeController extends Controller
{
    public function __construct(
        private HomeService $homeService
    ){
        $this->middleware('auth:patient');
    }

    public function getDoctors()
    {
        $data = $this->homeService->getDoctors();

        if(!$data){
            return $this->error('No doctors found');
        }
        return $this->success('Doctors fetched successfully', DoctorResource::collection($data));
    }

    public function getSpecialists()
    {
        $data = $this->homeService->getSpecialists();
        if(!$data){
            return $this->error('No specialists found');
        }
        return $this->success('Specialists fetched successfully', SpecialistResouce::collection($data));
    }

    public function searchDoctors(Request $request)
    {
        $data = $this->homeService->searchDoctors($request->all());
        if(!$data){
            return $this->error('No doctors found');
        }
        return $this->success('Doctors fetched successfully', DoctorResource::collection($data));
    }

    public function getSearchLogs()
    {
        $data = $this->homeService->getSearchLogs();
        return $this->success('Search logs fetched successfully', SearchLogResource::collection($data));
    }
}
