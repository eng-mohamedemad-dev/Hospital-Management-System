<?php

namespace App\Jobs;

use App\Mail\VerificationCodeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class OtpJob implements ShouldQueue
{
    use Queueable;

    public $user_type;

    public $user_id;

    public $code;

    public $type;

    public $expires_at;

    /**
     * Create a new job instance.
     */
    public function __construct($user_type, $user_id, $code, $type, $expires_at = null)
    {
        $this->user_type = $user_type;
        $this->user_id = $user_id;
        $this->code = $code;
        $this->type = $type;
        $this->expires_at = $expires_at ?? now()->addMinutes(10);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = $this->user_type::find($this->user_id);
        Mail::to($user->email)->send(new VerificationCodeMail($user, $this->code, $this->type, $this->expires_at));
    }
}
