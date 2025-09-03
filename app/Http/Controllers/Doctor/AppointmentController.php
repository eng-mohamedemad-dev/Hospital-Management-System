<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Interfaces\Doctor\AppointmentInterface;
use App\Http\Requests\Doctor\AppointmentRequest;

class AppointmentController extends Controller
{
    public function __construct(private AppointmentInterface $appointmentService)
    {
    }

    public function store(AppointmentRequest $request)
    {
        $appointment = $this->appointmentService->createAppointment($request->validated());

        if (!$appointment) {
            return $this->error('Appointment not created');
        }
        
        return $this->success('Appointment created successfully','');
    }

    public function index()
    {
        $appointments = $this->appointmentService->getAppointments();
        return $this->success('Appointments retrieved successfully', AppointmentResource::collection($appointments));
    }

    public function update(AppointmentRequest $request)
    {
        $appointment = $this->appointmentService->updateAppointment($request->validated());

        if (!$appointment) {
            return $this->error('Appointment not found or not authorized');
        }
        
        return $this->success('Appointment updated successfully',  '');
    }

    public function destroy($id)
    {
        $deleted = $this->appointmentService->deleteAppointment($id);

        if (!$deleted) {
            return $this->error('Appointment not found or not authorized');
        }
        
        return $this->success('Appointment deleted successfully');
    }
}
