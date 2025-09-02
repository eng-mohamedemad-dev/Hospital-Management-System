<?php

namespace App\Interfaces\Doctor;

interface ProfileInterface
{
    public function showProfile();
    public function updateProfile($data);
    public function updatePassword($data,$doctor);
}
