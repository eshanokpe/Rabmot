<?php

namespace App\Mail;

use App\Models\Setting;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawalPaidMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;

    public function __construct($email, $fullname, $amount, $transactionReference)
    {
        $this->email = $email;
        $this->fullname = $fullname;
        $this->amount = $amount;
        $this->transactionReference = $transactionReference;
    }

    public function build()
    {
        return $this->from(...Setting::mailFrom())
        ->subject('Your Withdrawal Has Been Paid')
        ->markdown('emails.withdrawal-paid-email')->with([
            'fullname' => $this->fullname,
            'amount' => $this->amount,
            'transactionReference' => $this->transactionReference,
        ]);
    }
}
