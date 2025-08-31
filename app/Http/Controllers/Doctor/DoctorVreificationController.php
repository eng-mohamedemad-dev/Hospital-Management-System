<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\DoctorResendRequest;
use App\Http\Requests\Doctor\DoctorVerifyRequest;
use App\Interfaces\Doctor\DoctorVerifyInterface;

class DoctorVreificationController extends Controller
{
    public function __construct(private DoctorVerifyInterface $doctorVerifyService)
    {
        $this->doctorVerifyService = $doctorVerifyService;
    }

    public function verifyEmail(DoctorVerifyRequest $request)
    {
        $user = $this->doctorVerifyService->verifyEmail($request->validated());
        if (! $user) {
            return $this->error('Email already verified.');
        }

        return $this->success('Email verified successfully.', true);
    }

    public function resendCode(DoctorResendRequest $request)
    {
        $user = $this->doctorVerifyService->resendCode($request->validated());
        if (! $user) {
            return $this->error('Email already verified.');
        }

        return $this->success('Code resend successfully.', true);
    }
}
