<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeliveryinprogressMode extends Mailable
{
    use Queueable, SerializesModels;

    protected $users; 

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() 
    {
        return $this->from('info@rabmotlicensing.com', 'Rabmot Licensing Agency')
        ->subject('Your Order Delivery is in Progress')
        ->markdown('emails.deliveryinprogress_mode')->with([
            'fullname' => $this->users->fullname, 
        ]);

       // return $this->markdown('emails.verification-email')->with(['email_token' => $this->user->email_token, 'fullname' => $this->user->fullname]);
    }
}
