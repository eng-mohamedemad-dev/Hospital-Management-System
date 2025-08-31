<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\DoctorLoginRequest;
use App\Http\Requests\Doctor\DoctorRegisterRequest;
use App\Interfaces\Doctor\DoctorAuthInterface;
use Illuminate\Http\Request;

class DoctorAuthController extends Controller
{
    public function __construct(private DoctorAuthInterface $doctorAuthService)
    {
        $this->doctorAuthService = $doctorAuthService;
    }

    public function register(DoctorRegisterRequest $request)
    {
        $doctor = $this->doctorAuthService->register($request->validated());

        return $this->success('Doctor registered successfully', $doctor);
    }

    public function login(DoctorLoginRequest $request)
    {
        $doctor = $this->doctorAuthService->login($request->validated());
        if (! $doctor) {
            return $this->error('Doctor not found');
        }

        return $this->success('Doctor logged in successfully', $doctor);
    }

    public function logout(Request $request)
    {
        $user = auth('doctor')->user();
        $user->currentAccessToken()->delete();

        return $this->success('Doctor logged out successfully');
    }
}
