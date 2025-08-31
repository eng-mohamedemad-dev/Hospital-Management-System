<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public $code;

    public $type;

    public $expires_at;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $code, $type, $expires_at = null)
    {
        $this->user = $user;
        $this->code = $code;
        $this->type = $type;
        $this->expires_at = $expires_at ?? now()->addMinutes(10);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verification Code Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.verification-code',
            with: [
                'user' => $this->user,
                'code' => $this->code,
                'type' => $this->type,
                'expires_at' => $this->expires_at,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
