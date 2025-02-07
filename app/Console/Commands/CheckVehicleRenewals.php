<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AddVehicleRenewal;
use Carbon\Carbon;
use App\Models\User; // Assuming you have a User model
use App\Notifications\VehicleRenewalReminderNotification;

class CheckVehicleRenewals extends Command
{
    protected $signature = 'check:vehicle-renewals';
    protected $description = 'Check vehicle renewals and send notifications';

    public function handle()
    {
        $vehicles = AddVehicleRenewal::with('vehicleTypeInfo')->get();

        foreach ($vehicles as $vehicle) {
            $this->checkAndSendNotification($vehicle, 'vehicle_license', 'Vehicle License');
            $this->checkAndSendNotification($vehicle, 'road_worthiness', 'Road Worthiness');
            $this->checkAndSendNotification($vehicle, 'insurance', 'Insurance');
            $this->checkAndSendNotification($vehicle, 'hackney_permit', 'Hackney Permit');
            $this->checkAndSendNotification($vehicle, 'state_carriage_permit', 'State Carriage Permit');
            $this->checkAndSendNotification($vehicle, 'mid_year_permit', 'Mid-Year Permit');
            $this->checkAndSendNotification($vehicle, 'local_government_permit', 'Local Government Permit');
        }

        $this->info('Vehicle renewal notifications sent successfully.');
    }

    private function checkAndSendNotification($vehicle, $field, $documentName)
    {
        $expiryDate = Carbon::parse($vehicle->$field);
        $remainingDays = Carbon::now()->diffInDays($expiryDate, false);

        if (in_array($remainingDays, [1, 2, 5])) {
            $this->sendNotification($vehicle, $documentName, $remainingDays);
        }
    }

    private function sendNotification($vehicle, $documentName, $remainingDays)
    {
        $user = User::where('email', $vehicle->user_email)->first(); // Fetch the user

        if ($user) {
            $message = "Reminder: Your {$documentName} will expire in {$remainingDays} days.";
            $user->notify(new VehicleRenewalReminderNotification($message));
        }
    }
}