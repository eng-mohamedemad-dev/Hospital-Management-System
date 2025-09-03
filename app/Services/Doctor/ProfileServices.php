<?php

namespace App\Services\Doctor;

use App\Interfaces\Doctor\ProfileInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileServices implements ProfileInterface
{
    private $doctor;
    public function __construct()
    {
        $this->doctor = auth('doctor')->user();
    }

    public function showProfile()
    {
        return $this->doctor;
    }

    public function updateProfile($data)
    {
        if (isset($data['current_password']) && isset($data['new_password']))
        {
            $data['password'] = $this->updatePassword($data['current_password'], $data['new_password']);
        }
        if(isset($data['image']))
        {
            $data['image'] = $this->updateImage($data['image']);
        }

        return $this->doctor->update($data);
    }

    public function deleteAccount()
    {
        return $this->doctor->delete();
    }


    private function updatePassword($current_password,$new_password)
    {
        if (! Hash::check($current_password, $this->doctor->password))
        {
            return false;
        }
        return $new_password;
    }

    private function updateImage($image)
    {
        $image = Storage::disk('public')->put('doctors', $image);
        if($this->doctor->image)
        {
            Storage::delete($this->doctor->image);
        }
        return $image;
    }
}
