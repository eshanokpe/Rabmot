<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\WalletPayment;

class WalletCreditNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $walletPayment;

    /**
     * Create a new notification instance.
     *
     * @param WalletPayment $walletPayment
     */
    public function __construct(WalletPayment $walletPayment)
    {
        $this->walletPayment = $walletPayment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Wallet Credit Notification')
            ->greeting('Hello, ' . $this->walletPayment->user_email)
            ->line('We have credited your wallet with an amount of ' . number_format($this->walletPayment->amount, 2) . '.')
            ->line('Transaction Reference: ' . $this->walletPayment->process_number)
            ->line('Thank you for using our service!');
    }

    /**
     * Get the array representation of the notification for storage in the database.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'amount' => $this->walletPayment->amount,
            'transaction_reference' => $this->walletPayment->process_number,
            'message' => 'Your wallet has been credited with ' . number_format($this->walletPayment->amount, 2),
        ];
    }
}
