<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\DoctorCheckPasswordRequest;
use App\Http\Requests\Doctor\DoctorForgetPasswordRequest;
use App\Http\Requests\Doctor\DoctorResetPasswordRequest;
use App\Interfaces\Doctor\DoctorPasswordInterface;

class DoctorPasswordController extends Controller
{
    public function __construct(private DoctorPasswordInterface $doctorPasswordService)
    {
        $this->doctorPasswordService = $doctorPasswordService;
    }

    public function forget(DoctorForgetPasswordRequest $request)
    {
        $result = $this->doctorPasswordService->forget($request->validated());
        if (! $result) {
            return $this->error('Email not found');
        }

        return $this->success('Password reset code sent successfully');
    }

    public function check(DoctorCheckPasswordRequest $request)
    {
        $result = $this->doctorPasswordService->check($request->validated());
        if (! $result) {
            return $this->error('Invalid code');
        }

        return $this->success('Code verified successfully', $result);
    }

    public function reset(DoctorResetPasswordRequest $request)
    {
        $result = $this->doctorPasswordService->reset($request->validated());
        if (! $result) {
            return $this->error('Invalid token');
        }

        return $this->success('Password reset successfully');
    }
}
