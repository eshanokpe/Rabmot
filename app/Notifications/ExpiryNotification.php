<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExpiryNotification extends Notification
{
    use Queueable;

    private $vehicle;
    private $expiringDetails;

    /**
     * Create a new notification instance.
     *
     * @param  object  $vehicle
     * @param  array  $expiringDetails
     */
    public function __construct($vehicle, $expiringDetails)
    {
        $this->vehicle = $vehicle;
        $this->expiringDetails = $expiringDetails;
    }

    /**
     * Get the notification delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $details = '';
        foreach ($this->expiringDetails as $field => $date) {
            $formattedField = ucfirst(str_replace(['expiry', '_'], ['', ' '], $field));
            $formattedDate = Carbon::parse($date)->format('F j, Y');
            $details .= "{$formattedField}: {$formattedDate}\n";
        }

        return (new MailMessage)
            ->from('info@rabmotlicensing.com', 'Rabmot Licensing Agency')
            ->subject('Vehicle Expiry Notification')
            ->line("Dear {$this->vehicle->user->fullname},") 
            ->line("The following documents for your vehicle {$this->vehicle->vehicleTypeInfo->name} ({$this->vehicle->platenumber}) are about to expire:")
            ->line(new \Illuminate\Support\HtmlString($details)) 
            ->action('View Vehicle', route('home.notifications.index', encrypt($this->vehicle->id)))
            ->line('Please ensure to renew the necessary documents promptly.');
    }

    /**
     * Build the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $formattedExpiries = [];
        foreach ($this->expiringDetails as $field => $date) {
            $formattedExpiries[$field] = Carbon::parse($date)->format('F j, Y');
        }

        return [
            'vehicle_id' => $this->vehicle->id,
            'platenumber' => $this->vehicle->platenumber,
            'user_name' => $this->vehicle->user->fullname,
            'expiries' => $formattedExpiries,
            'title' => 'Vehicle Expiry Notification',
            'message' => "The documents for your vehicle ({$this->vehicle->vehicleTypeInfo->name}, Plate: {$this->vehicle->platenumber}) are nearing expiry.",
        ];
    }
}
