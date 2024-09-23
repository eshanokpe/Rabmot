<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;
 
    // Properties to hold the data passed to the Mailable
    public $orderNo;
    public $fullname;
    public $email;
    public $phone;
    public $item;
    public $cartItems;
    public $totalAmount;
    public $invoiceNumber;
    public $saleDate;

    /**
     * Create a new message instance.
     *
     * @param string $orderNo
     * @param string $fullname
     * @param string $email
     * @param mixed $item
     * @param string|null $newDriverLicense
     * @param string|null $driverLicenseRenewal
     * @param string|null $changeOfOwnership
     * @param string|null $dealerPlateNumber
     * @param string|null $vehicleRenewal
     * @param string|null $vehicleRegistration
     * @param string|null $internationalDL
     * @return void
     */
    public function __construct(
        $orderNo, 
        $fullname, 
        $email, 
        $phone,
        $item,
        $cartItems,
        $totalAmount,
        $invoiceNumber,
        $saleDate
    ) {
        $this->orderNo = $orderNo;
        $this->fullname = $fullname;
        $this->email = $email;
        $this->phone = $phone;
        $this->item = json_decode($item, true);
        $this->cartItems = $cartItems; 
        $this->totalAmount = $totalAmount;
        $this->invoiceNumber = $invoiceNumber;
        $this->saleDate = $saleDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('info@rabmotlicensing.com', 'Rabmot Licensing Agency')
                    ->subject('Your Invoice from Rabmot Licensing Agency')
                    ->markdown('emails.invoice')
                    ->with([
                        'orderNo' => $this->orderNo,
                        'fullname' => $this->fullname,
                        'email' => $this->email,
                        'phone' => $this->phone,
                        'item' => $this->item, 
                        'cartItems' => $this->cartItems,
                        'totalAmount'=> $this->totalAmount,
                        'invoiceNumber'=> $this->invoiceNumber,
                        'saleDate' => $this->saleDate
                    ]);
        
    }
}
