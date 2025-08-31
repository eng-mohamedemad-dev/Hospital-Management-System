<?php

namespace App\Interfaces\Patient;

interface PatientVerifyInterface
{
    public function verifyEmail($data);

    public function resendCode($data);
}
