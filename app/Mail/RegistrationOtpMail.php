<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public string $otpCode)
    {
    }

    public function build(): self
    {
        return $this->subject('Kode OTP Pendaftaran Laporin')
            ->markdown('emails.registration-otp', [
                'otpCode' => $this->otpCode,
            ]);
    }
}
