<?php

namespace App\Services\Doctor;

use App\Interfaces\Doctor\AppointmentInterface;
use App\Models\Appointment;

class AppointmentService implements AppointmentInterface
{
    protected $doctor;

    public function __construct()
    {
        $this->doctor = auth('doctor')->user();
    }

    public function createAppointment(array $data)
    {
        foreach($data['appointments'] as $appointment)
        {
            $appointment['doctor_id'] = $this->doctor->id;
            Appointment::create($appointment);
        }
        return true;
    }

    public function getAppointments()
    {
        return Appointment::where('doctor_id', $this->doctor->id)->get();
    }

    public function updateAppointment(array $data)
    {
       $data['doctor_id'] = $this->doctor->id;
       foreach($data['appointments'] as $appointment_data)
       {
            $appointment['doctor_id'] = $this->doctor->id;
            $appointment = Appointment::where('id', $appointment_data['id'])->first();
            if(!$appointment)
            {
                return false;
            }
            $appointment->update($appointment_data);
       }
       return true;
    }

    public function deleteAppointment($id)
    {
        $appointment = Appointment::where('id', $id)->where('doctor_id', $this->doctor->id)->first();
        if(!$appointment)
        {
            return false;
        }
        return $appointment->delete();
    }
}
