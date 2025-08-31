<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\PatientLoginRequest;
use App\Http\Requests\Patient\PatientRegisterRequest;
use App\Interfaces\Patient\PatientAuthInterface;
use Illuminate\Http\Request;

class PatientAuthController extends Controller
{
    public function __construct(private PatientAuthInterface $patientAuthService)
    {
        $this->patientAuthService = $patientAuthService;
    }

    public function register(PatientRegisterRequest $request)
    {
        $patient = $this->patientAuthService->register($request->validated());

        return $this->success('Patient registered successfully', $patient);
    }

    public function login(PatientLoginRequest $request)
    {
        $patient = $this->patientAuthService->login($request->validated());
        if (! $patient) {
            return $this->error('Patient not found');
        }

        return $this->success('Patient logged in successfully', $patient);
    }

    public function logout(Request $request)
    {
        $user = auth('patient')->user();
        $user->currentAccessToken()->delete();

        return $this->success('Patient logged out successfully');
    }
}
