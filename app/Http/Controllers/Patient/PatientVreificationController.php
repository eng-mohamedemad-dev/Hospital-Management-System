<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Http\Requests\Patient\PatientResendRequest;
use App\Http\Requests\Patient\PatientVerifyRequest;
use App\Interfaces\Patient\PatientVerifyInterface;

class PatientVreificationController extends Controller
{
    public function __construct(private PatientVerifyInterface $patientVerifyService)
    {
        $this->patientVerifyService = $patientVerifyService;
    }

    public function verifyEmail(PatientVerifyRequest $request)
    {
        $user = $this->patientVerifyService->verifyEmail($request->validated());
        if (! $user) {
            return $this->error('Email already verified.');
        }

        return $this->success('Email verified successfully.', true);
    }

    public function resendCode(PatientResendRequest $request)
    {
        $user = $this->patientVerifyService->resendCode($request->validated());
        if (! $user) {
            return $this->error('Email already verified.');
        }

        return $this->success('Code resend successfully.', true);
    }
}
