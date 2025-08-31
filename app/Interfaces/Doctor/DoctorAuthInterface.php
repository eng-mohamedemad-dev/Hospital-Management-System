<?php

namespace App\Interfaces\Doctor;

interface DoctorAuthInterface
{
    public function register($data);

    public function login($data);
}
