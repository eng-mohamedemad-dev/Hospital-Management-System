<?php

namespace App\Interfaces\Doctor;

interface AppointmentInterface
{
    public function createAppointment(array $data);
    public function getAppointments();
    public function updateAppointment(array $data);
    public function deleteAppointment($id);
}
