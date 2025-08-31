<?php

namespace App\Services\Patient;

use App\Interfaces\Patient\PatientAuthInterface;
use App\Jobs\OtpJob;
use App\Models\Patient;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Hash;

class PatientAuthService implements PatientAuthInterface
{
    public function register($data)
    {
        $patient = Patient::create($data);
        $verificationCode = VerificationCode::create([
            'user_type' => 'patient',
            'user_id' => $patient->id,
            'code' => rand(100000, 999999),
            'type' => 'email_verification',
            'expires_at' => now()->addMinutes(10),
        ]);
        dispatch(new OtpJob(Patient::class, $patient->id, $verificationCode->code, 'email_verification', $verificationCode->expires_at));

        return $this->returnData($patient);
    }

    public function login($data)
    {
        $remember_me = $data['remember_me'] ?? false;
        $patient = Patient::where('email', $data['email'])->first();
        if (! $patient || ! Hash::check($data['password'], $patient->password)) {
            return false;
        }
        $token = $remember_me ? $patient->createToken('patient_token', ['*'], now()->addDays(20))->plainTextToken : $patient->createToken('patient_token', ['*'], now()->addDays(1))->plainTextToken;

        return [
            'patient' => $this->returnData($patient),
            'token' => $token,
        ];
    }

    protected function returnData($patient)
    {
        return [
            'email' => $patient->email,
            'phone' => $patient->phone,
        ];
    }
}
