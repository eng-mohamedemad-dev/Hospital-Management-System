<?php

namespace App\Interfaces\Doctor;

interface DoctorPasswordInterface
{
    public function forget($data);

    public function check($data);

    public function reset($data);
}
