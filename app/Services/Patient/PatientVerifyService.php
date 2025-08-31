<?php

namespace App\Services\Patient;

use App\Interfaces\Patient\PatientVerifyInterface;
use App\Jobs\OtpJob;
use App\Models\Patient;

class PatientVerifyService implements PatientVerifyInterface
{
    public function verifyEmail($data)
    {
        $user = Patient::where('email', $data['email'])->first();
        $veify = $user->verificationCodes();
        if (! $user || $veify->where('type', 'email_verification')->value('verified_at') != null) {
            return false;
        }
        $result = $veify->where('type', 'email_verification')->update([
            'code' => null,
            'verified_at' => now(),
            'expires_at' => null,
        ]);

        return $result;
    }

    public function resendCode($data)
    {
        $user = Patient::where('email', $data['email'])->first();
        $verify = $user->verificationCodes();
        if (! $user || $verify->where('type', 'email_verification')->value('verified_at') != null) {
            return false;
        }
        $result = tap($verify->where('type', 'email_verification')->first(), function ($verify) {
            $verify->update([
                'code' => rand(100000, 999999),
                'expires_at' => now()->addMinutes(10),
            ]);
        });
        dispatch(new OtpJob(Patient::class, $user->id, $result->code, 'email_verification', $result->expires_at));

        return $result;
    }
}
