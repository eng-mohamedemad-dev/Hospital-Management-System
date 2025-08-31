<?php

namespace App\Services\Doctor;

use App\Interfaces\Doctor\DoctorPasswordInterface;
use App\Jobs\OtpJob;
use App\Models\Doctor;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DoctorPasswordService implements DoctorPasswordInterface
{
    public function forget($data)
    {
        $doctor = Doctor::where('email', $data['email'])->first();
        if (! $doctor) {
            return false;
        }
        $doctor->verificationCodes()->where('type', 'password_reset')->delete();
        // Create password reset verification code
        $verificationCode = VerificationCode::create([
            'user_type' => 'doctor',
            'user_id' => $doctor->id,
            'code' => rand(100000, 999999),
            'type' => 'password_reset',
            'expires_at' => now()->addMinutes(10),
        ]);

        // Send email with code
        dispatch(new OtpJob(Doctor::class, $doctor->id, $verificationCode->code, 'password_reset', $verificationCode->expires_at));

        return true;
    }

    public function check($data)
    {
        $doctor = Doctor::where('email', $data['email'])->first();
        if (! $doctor) {
            return false;
        }

        // Check if code is valid and not expired
        $verificationCode = $doctor->verificationCodes()
            ->where('type', 'password_reset')
            ->where('code', $data['code'])
            ->where('expires_at', '>', now())
            ->first();

        if (! $verificationCode) {
            return false;
        }

        // Generate reset token
        $token = Str::random(60);
        $verificationCode->update(['token' => $token]);

        return [
            'token' => $token,
            'expires_at' => $verificationCode->expires_at->format('Y-m-d H:i:s'),
        ];
    }

    public function reset($data)
    {
        // Find verification code by token and ensure it's for the correct user
        $verificationCode = VerificationCode::where('token', $data['token'])
            ->where('type', 'password_reset')
            ->where('user_type', 'doctor')
            ->where('expires_at', '>', now())
            ->first();

        if (! $verificationCode) {
            return false;
        }

        // Get the doctor and verify ownership
        $doctor = Doctor::find($verificationCode->user_id);
        if (! $doctor) {
            return false;
        }

        // Update doctor password
        // delete forget password code
        $verificationCode->delete();
        // delete all tokens related to this doctor
        $doctor->tokens()->delete();

        $doctor->update(['password' => Hash::make($data['password'])]);

        return true;
    }
}
