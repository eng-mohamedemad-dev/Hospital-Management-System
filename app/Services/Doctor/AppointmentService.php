<?php

namespace App\Services\Doctor;

use App\Interfaces\Doctor\AppointmentInterface;
use App\Models\Appointment;
class AppointmentService implements AppointmentInterface
{


    public function index()
    {

    }


    public function store(array $data)
    {

        $data['time_from'] = str_replace('.', ':', $data['time_from']);
        $data['time_to'] = str_replace('.', ':', $data['time_to']);


        $create = Appointment::create($data);
        return $create;
    }

    public function updateAppointment($data,$appointment)
    {


        $data['time_from'] = str_replace('.', ':', $data['time_from']);
        $data['time_to'] = str_replace('.', ':', $data['time_to']);

        $appointment->update($data);
        return $appointment;
    }
}
