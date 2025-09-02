<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Interfaces\Doctor\ProfileInterface;
use App\Models\Doctor;

class ProfileController extends Controller
{
    public function __construct(private ProfileInterface $profileService)
    {

    }

    public function showProfile()
    {
        $doctor = Doctor::with('address')->find(auth('doctor')->id());
        // dd($doctor);

        if(!$doctor)
        {
            return $this->error('Doctor not found');
        }
        return $this->success('Doctor profile retrieved successfully', new DoctorResource($doctor));
    }

    public function updateProfile(Request $request, $doctor)
    {
        $data   = $request->all();
        $doctor = $this->profileService->updateProfile($data,$doctor);

        if(!$doctor)
        {
            return $this->error('You are not authorized to update this profile');
        }
        return $this->success('Doctor profile updated successfully', new DoctorResource($doctor));
    }

    public function updatePassword(Request $request, $doctor)
    {
        $data   = $request->all();
        $doctor = $this->profileService->updatePassword($data,$doctor);

        if(!$doctor)
        {
            return $this->error('You are not authorized to update this password');
        }
        return $this->success('Doctor password updated successfully', new DoctorResource($doctor));
    }
}
