<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VehicleRenewalReminderNotification extends Notification
{
    use Queueable;

    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // Send via database and email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('info@rabmotlicensing.com', 'Rabmot Licensing Agency')
            ->subject('Vehicle Renewal Reminder')
            ->line($this->message);
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'renewal_date' => now()->toDateTimeString(),
        ];
    }
}