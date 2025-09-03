<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Interfaces\Doctor\ProfileInterface;
use App\Http\Requests\Doctor\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function __construct(private ProfileInterface $profileService)
    {

    }

    public function showProfile()
    {
        $doctor = $this->profileService->showProfile();

        return $this->success('Doctor profile retrieved successfully', new DoctorResource($doctor));
    }


    public function updateProfile(ProfileUpdateRequest $request)
    {
        $data   = $request->validated();
        $doctor = $this->profileService->updateProfile($data);
        if(!$doctor){
            return $this->error('Password is incorrect');
        }
        return $this->success('Doctor profile updated successfully','');
    }

    public function deleteAccount()
    {
        $doctor = $this->profileService->deleteAccount();
        return $this->success('Doctor account deleted successfully');
        if(!$doctor){
            return $this->error('Doctor account not deleted');
        }
    }

}
