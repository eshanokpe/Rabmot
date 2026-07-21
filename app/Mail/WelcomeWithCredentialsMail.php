<?php

namespace App\Mail;

use App\Models\Setting;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeWithCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fullname;
    public $email;
    public $tempPassword;
    public $processType;
    public $processId;
    public $amount;

    public function __construct($fullname, $email, $tempPassword, $processType, $processId, $amount)
    {
        $this->fullname      = $fullname;
        $this->email         = $email;
        $this->tempPassword  = $tempPassword;
        $this->processType   = $processType;
        $this->processId     = $processId;
        $this->amount        = $amount;
    }

    public function build()
    {
        return $this->from(...Setting::mailFrom())
            ->subject('Welcome to Rabmot – Your Account & Application Details')
            ->markdown('emails.welcome-with-credentials')
            ->with([
                'fullname'     => $this->fullname,
                'email'        => $this->email,
                'tempPassword' => $this->tempPassword,
                'processType'  => $this->processType,
                'processId'    => $this->processId,
                'amount'       => $this->amount,
            ]);
    }
}
