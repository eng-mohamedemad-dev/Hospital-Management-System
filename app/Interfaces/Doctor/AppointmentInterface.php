<?php

namespace App\Interfaces\Doctor;

interface AppointmentInterface
{
    public function store(array $details);
    public function updateAppointment($data,$appointment);
    // public function deleteAppointment(int $id);
    // public function getAppointmentsByDoctor(int $doctorId);
    public function index();
}
