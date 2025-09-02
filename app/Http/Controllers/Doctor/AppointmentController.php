<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppointmentResource;
use App\Interfaces\Doctor\AppointmentInterface;
use App\Http\Requests\Doctor\AppointmentRequest;

class AppointmentController extends Controller
{
    public function __construct(private AppointmentInterface $appointmentService)
    {

    }

    public function index()
    {
        //
    }

    public function store(AppointmentRequest $request)
    {
        $data           = $request->validated();
        $appointment    = $this->appointmentService->store($data);

        if(!$appointment)
        {
            return $this->error('Appointment not created');
        }
        return $this->success('Appointment created successfully', new AppointmentResource($appointment));
    }

    public function updateAppointment(AppointmentRequest $request,Appointment  $appointment)
    {
        $data           = $request->validated();
        $appointment    = $this->appointmentService->updateAppointment($data,$appointment);

        if(!$appointment)
        {
            return $this->error('You are not authorized to update this appointment');
        }
        return $this->success('Appointment updated successfully', new AppointmentResource($appointment));
    }
}
