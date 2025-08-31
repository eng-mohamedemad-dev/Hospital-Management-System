<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\PatientCheckPasswordRequest;
use App\Http\Requests\Patient\PatientForgetPasswordRequest;
use App\Http\Requests\Patient\PatientResetPasswordRequest;
use App\Interfaces\Patient\PatientPasswordInterface;

class PatientPasswordController extends Controller
{
    public function __construct(private PatientPasswordInterface $patientPasswordService)
    {
        $this->patientPasswordService = $patientPasswordService;
    }

    public function forget(PatientForgetPasswordRequest $request)
    {
        $result = $this->patientPasswordService->forget($request->validated());
        if (! $result) {
            return $this->error('Email not found');
        }

        return $this->success('Password reset code sent successfully');
    }

    public function check(PatientCheckPasswordRequest $request)
    {
        $result = $this->patientPasswordService->check($request->validated());
        if (! $result) {
            return $this->error('Invalid code');
        }

        return $this->success('Code verified successfully', $result);
    }

    public function reset(PatientResetPasswordRequest $request)
    {
        $result = $this->patientPasswordService->reset($request->validated());
        if (! $result) {
            return $this->error('Invalid token');
        }

        return $this->success('Password reset successfully');
    }
}
