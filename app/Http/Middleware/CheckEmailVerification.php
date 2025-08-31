<?php

namespace App\Http\Middleware;

use App\Models\Doctor;
use App\Models\Patient;
use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmailVerification
{
    use ApiResponse;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type): Response
    {
        // Get user from the current guard (doctor or patient)
        $email = request()->email;
        $user = [
            'doctor' => Doctor::class,
            'patient' => Patient::class,
        ];
        $user = $user[$type]::where('email', $email)->first();

        if (! $user) {
            return $this->error('Email not found', 404);
        }

        // Use morph relation to check if email is verified
        $verificationCode = $user->verificationCodes()
            ->where('type', 'email_verification')
            ->where('verified_at', null)
            ->first();

        if ($verificationCode) {
            return $this->error('Email not verified. Please verify your email first.', 403);
        }

        return $next($request);
    }
}
