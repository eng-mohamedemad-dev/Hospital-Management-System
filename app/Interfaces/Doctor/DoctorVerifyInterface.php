<?php

namespace App\Interfaces\Doctor;

interface DoctorVerifyInterface
{
    public function verifyEmail($data);

    public function resendCode($data);
}
