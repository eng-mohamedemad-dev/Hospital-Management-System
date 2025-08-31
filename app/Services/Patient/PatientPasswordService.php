<?php

namespace App\Services\Patient;

use App\Interfaces\Patient\PatientPasswordInterface;
use App\Jobs\OtpJob;
use App\Models\Patient;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PatientPasswordService implements PatientPasswordInterface
{
    public function forget($data)
    {
        $patient = Patient::where('email', $data['email'])->first();
        if (! $patient) {
            return false;
        }
        $patient->verificationCodes()->where('type', 'password_reset')->delete();
        // Create password reset verification code
        $verificationCode = VerificationCode::create([
            'user_type' => 'patient',
            'user_id' => $patient->id,
            'code' => rand(100000, 999999),
            'type' => 'password_reset',
            'expires_at' => now()->addMinutes(10),
        ]);

        // Send email with code
        dispatch(new OtpJob(Patient::class, $patient->id, $verificationCode->code, 'password_reset', $verificationCode->expires_at));

        return true;
    }

    public function check($data)
    {
        $patient = Patient::where('email', $data['email'])->first();
        if (! $patient) {
            return false;
        }

        // Check if code is valid and not expired
        $verificationCode = $patient->verificationCodes()
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
            ->where('user_type', 'patient')
            ->where('expires_at', '>', now())
            ->first();

        if (! $verificationCode) {
            return false;
        }

        // Get the patient and verify ownership
        $patient = Patient::find($verificationCode->user_id);
        if (! $patient) {
            return false;
        }

        // Update patient password
        // delete forget password code
        $verificationCode->delete();
        // delete all tokens related to this patient
        $patient->tokens()->delete();

        $patient->update(['password' => Hash::make($data['password'])]);

        return true;
    }
}
