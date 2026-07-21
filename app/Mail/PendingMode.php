<?php

namespace App\Mail;

use App\Models\Setting;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PendingMode extends Mailable
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
        return $this->from(...Setting::mailFrom())
        ->subject('Your Order is Pending Confirmation')
        ->markdown('emails.pending_mode')->with([
            'fullname' => $this->users->fullname,  
        ]);

       // return $this->markdown('emails.verification-email')->with(['email_token' => $this->user->email_token, 'fullname' => $this->user->fullname]);
    }
}
