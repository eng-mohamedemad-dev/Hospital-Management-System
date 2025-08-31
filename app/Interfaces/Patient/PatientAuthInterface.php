<?php

namespace App\Interfaces\Patient;

interface PatientAuthInterface
{
    public function register($data);

    public function login($data);
}
