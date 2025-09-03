<?php

namespace App\Interfaces\Patient;

interface HomeInterface
{
    public function getDoctors();
    public function getSpecialists();
   
    public function searchDoctors($data);

    public function getSearchLogs();
}
