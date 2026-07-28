<?php

namespace App\Mail;

use App\Models\Setting;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawalRejectedMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;

    public function __construct($email, $fullname, $amount, $rejectionReason)
    {
        $this->email = $email;
        $this->fullname = $fullname;
        $this->amount = $amount;
        $this->rejectionReason = $rejectionReason;
    }

    public function build()
    {
        return $this->from(...Setting::mailFrom())
        ->subject('Update on Your Withdrawal Request')
        ->markdown('emails.withdrawal-rejected-email')->with([
            'fullname' => $this->fullname,
            'amount' => $this->amount,
            'rejectionReason' => $this->rejectionReason,
        ]);
    }
}
