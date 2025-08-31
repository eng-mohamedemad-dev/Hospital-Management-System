<?php

namespace App\Services\Doctor;

use App\Interfaces\Doctor\DoctorAuthInterface;
use App\Jobs\OtpJob;
use App\Models\Doctor;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Hash;

class DoctorAuthService implements DoctorAuthInterface
{
    public function register($data)
    {
        $doctor = Doctor::create($data);
        $verificationCode = VerificationCode::create([
            'user_type' => 'doctor',
            'user_id' => $doctor->id,
            'code' => rand(100000, 999999),
            'type' => 'email_verification',
            'expires_at' => now()->addMinutes(10),
        ]);
        dispatch(new OtpJob(Doctor::class, $doctor->id, $verificationCode->code, 'email_verification', $verificationCode->expires_at));

        return $this->returnData($doctor);
    }

    public function login($data)
    {
        $remember_me = $data['remember_me'] ?? false;
        $doctor = Doctor::where('email', $data['email'])->first();
        if (! $doctor || ! Hash::check($data['password'], $doctor->password)) {
            return false;
        }
        $token = $remember_me ? $doctor->createToken('doctor_token', ['*'], now()->addDays(20))->plainTextToken : $doctor->createToken('doctor_token', ['*'], now()->addDays(1))->plainTextToken;

        return [
            'doctor' => $this->returnData($doctor),
            'token' => $token,
        ];
    }

    protected function returnData($doctor)
    {
        return [
            'email' => $doctor->email,
            'name' => $doctor->name,
        ];
    }
}
