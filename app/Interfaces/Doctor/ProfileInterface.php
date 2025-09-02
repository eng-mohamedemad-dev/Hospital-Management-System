<?php

namespace App\Interfaces\Doctor;

interface ProfileInterface
{
    public function showProfile();
    public function updateProfile($data,$doctor);
    public function updatePassword($data,$doctor);
}
