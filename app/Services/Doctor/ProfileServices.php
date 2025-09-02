<?php

namespace App\Services\Doctor;

use App\Interfaces\Doctor\ProfileInterface;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class ProfileServices implements ProfileInterface
{
    public function showProfile()
    {
        // Logic to show the doctor's profile
    }

    public function updateProfile($data,$doctor)
    {
        $doctor->update($data);
        return $this->returnData($doctor);
    }


    public function updatePassword($data,$doctor)
    {
        if (! Hash::check($data['current_password'], $doctor->password))
        {
            return false;
        }
        $doctor->update(['password' => Hash::make($data['new_password'])]);
        return true;
    }
}
