<?php

namespace App\Mail;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerificationCode extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $code
    ) {
    }

    public function build(): self
    {
        return $this->from(...Setting::mailFrom())
            ->subject('Your Rabmot email verification code')
            ->markdown('emails.verification-code')
            ->with([
                'fullname' => $this->user->fullname,
                'code' => $this->code,
            ]);
    }
}
