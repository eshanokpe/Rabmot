<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentRegistrationReceivedMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;

    public function __construct($email, $fullname, $username)
    {
        $this->email = $email;
        $this->fullname = $fullname;
        $this->username = $username;
    }

    public function build()
    {
        return $this->from('info@rabmotlicensing.com', 'Rabmot Licensing Agency')
        ->subject('Your Agent Application Has Been Received')
        ->markdown('emails.agent-registration-received-email')->with([
            'fullname' => $this->fullname,
            'username' => $this->username,
            'email' => $this->email,
        ]);
    }
}
