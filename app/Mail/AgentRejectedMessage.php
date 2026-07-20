<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentRejectedMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;

    public function __construct($email, $fullname, $username, $rejectionReason)
    {
        $this->email = $email;
        $this->fullname = $fullname;
        $this->username = $username;
        $this->rejectionReason = $rejectionReason;
    }

    public function build()
    {
        return $this->from('info@rabmotlicensing.com', 'Rabmot Licensing Agency')
        ->subject('Update on Your Agent Application')
        ->markdown('emails.agent-rejected-email')->with([
            'fullname' => $this->fullname,
            'username' => $this->username,
            'email' => $this->email,
            'rejectionReason' => $this->rejectionReason,
        ]);
    }
}
