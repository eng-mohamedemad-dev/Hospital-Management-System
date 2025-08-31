<?php

namespace App\Interfaces\Patient;

interface PatientPasswordInterface
{
    public function forget($data);

    public function check($data);

    public function reset($data);
}
