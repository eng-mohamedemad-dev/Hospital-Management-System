<?php

namespace App\Services\Doctor;

use App\Interfaces\Doctor\ProfileInterface;
use App\Models\Address;
use App\Models\Doctor;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileServices implements ProfileInterface
{
    public function showProfile()
    {
        $doctor = Doctor::with('specialist','address')->find(auth('doctor')->id());
        if(!$doctor)
        {
            return false;
        }
        return $this->returnData($doctor);
    }

    public function updateProfile($data)
    {
        $doctor = Doctor::find(auth('doctor')->id());
        if(!$doctor)
        {
            return false;
        }
        if(isset($data['image']))
        {
            $data['image'] = Storage::put('doctors', $data['image']);

            // Delete old image if exists
            if($doctor->image)
            {
                Storage::delete($doctor->image);
            }
        }

        if(isset($data['email']) && $data['email'] !== $doctor->email)
        {
            $data['email_verified_at'] = null; // Reset email verification if email is changed
        }
        $doctor->update($data);
        dd($data);
        if (isset($data['address']) || isset($data['state']) || isset($data['country']) && empty($doctor->address))
        {
            Address::create(
            [
                'doctor_id' => $doctor->id,
                'address' => $data['address'] ?? null,
                'state' => $data['state'] ?? null,
                'country' => $data['country'] ?? null,
            ]); // Update or create address record
        }else
        {
            $doctor->address->update(
            [
                'address' => $data['address'] ?? $doctor->address->address,
                'state' => $data['state'] ?? $doctor->address->state,
                'country' => $data['country'] ?? $doctor->address->country,
            ]);
        }
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
