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

    public function __construct($vehicle)
    {
        $this->vehicle = $vehicle;
    }

    public function via($notifiable)
    {
        // Include both 'mail' and 'database' channels
        return ['mail', 'database'];  
        // return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->from('info@rabmotlicensing.com', 'Rabmot Licensing Agency')
            ->subject('Vehicle Document Expiry Reminder')
            ->line("Dear {$this->vehicle->user->fullname},") 
            ->line("The following documents for your vehicle {$this->vehicle->vehicleTypeInfo->name} ({$this->vehicle->platenumber}) are nearing expiry:")
            ->line("- Vehicle License: " . Carbon::parse($this->vehicle->vehiclelicenseexpiry)->format('F j, Y'))
            ->line("- Road Worthiness: " . Carbon::parse($this->vehicle->roadworthinessexpiry)->format('F j, Y'))
            ->line("- Insurance: " . Carbon::parse($this->vehicle->insuranceexpiry)->format('F j, Y'))
            ->line("- Hackney Permit: " . Carbon::parse($this->vehicle->hackneypermitexpiry)->format('F j, Y'))
            ->line("- State Carriage Permit: " . Carbon::parse($this->vehicle->statecarriagepermitexpiry)->format('F j, Y'))
            ->line("- Mid-Year Permit: " . Carbon::parse($this->vehicle->hackneydutypermitexpiry)->format('F j, Y'))
            ->line("- Local Government Permit: " . Carbon::parse($this->vehicle->localgovernmentpermitexpiry)->format('F j, Y'))
            ->action('View Vehicle Details', url('/user/vehicles'))
            ->line('Please renew the documents to avoid penalties.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'vehicle_id' => $this->vehicle->id,
            'platenumber' => $this->vehicle->platenumber,
            'user_name' => $this->vehicle->user->fullname,
            'expiries' => [
                'vehiclelicenseexpiry' => Carbon::parse($this->vehicle->vehiclelicenseexpiry)->format('F j, Y'),
                'roadworthinessexpiry' => Carbon::parse($this->vehicle->roadworthinessexpiry)->format('F j, Y'),
                'insuranceexpiry' => Carbon::parse($this->vehicle->insuranceexpiry)->format('F j, Y'),
                'hackneypermitexpiry' => Carbon::parse($this->vehicle->hackneypermitexpiry)->format('F j, Y'),
                'statecarriagepermitexpiry' => Carbon::parse($this->vehicle->statecarriagepermitexpiry)->format('F j, Y'),
                'hackneydutypermitexpiry' => Carbon::parse($this->vehicle->hackneydutypermitexpiry)->format('F j, Y'),
                'localgovernmentpermitexpiry' => Carbon::parse($this->vehicle->localgovernmentpermitexpiry)->format('F j, Y'),
            ],
            'message' => "The documents for vehicle {$this->vehicle->vehicleTypeInfo->name} ({$this->vehicle->platenumber}) are nearing expiry.",
        ];
    }
}


