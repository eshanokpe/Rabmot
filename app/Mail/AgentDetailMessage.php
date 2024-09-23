<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentDetailMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $fullname, $username, $password)
    {
        $this->email = $email;
        $this->username = $username;
        $this->fullname = $fullname;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@rabmotlicensing.com', 'Rabmot Licensing Agency')
        ->subject('Welcome to Rabmot Licensing Agency Sub Agent Program!')
        ->markdown('emails.agentdetails-email')->with([
            'fullname' => $this->fullname, 
            'username' => $this->username,
            'email' => $this->email, 
            'password' =>  $this->password
        ]);
    }
}
 