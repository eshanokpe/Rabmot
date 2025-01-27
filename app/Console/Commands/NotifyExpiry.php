<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AddVehicleRenewal;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ExpiryNotification;
use Carbon\Carbon;

class NotifyExpiry extends Command
{
    protected $signature = 'notify:expiry';
    protected $description = 'Notify users about upcoming expirations';

    public function handle()
    {
        $today = Carbon::today();

        // Get vehicles with expiry dates 30, 15, 10, or 5 days away
        $vehicles = AddVehicleRenewal::with('user')
            ->where(function ($query) use ($today) {
                foreach (['vehiclelicenseexpiry', 'roadworthinessexpiry', 'insuranceexpiry', 'hackneypermitexpiry', 'statecarriagepermitexpiry', 'hackneydutypermitexpiry', 'localgovernmentpermitexpiry'] as $field) {
                    $query->orWhereDate($field, $today->copy()->addDays(5)->format('Y-m-d'))
                        ->orWhereDate($field, $today->copy()->addDays(1)->format('Y-m-d'))
                        ->orWhereDate($field, $today->copy()->addDays(10)->format('Y-m-d'))
                        ->orWhereDate($field, $today->copy()->addDays(15)->format('Y-m-d'))
                        ->orWhereDate($field, $today->copy()->addDays(20)->format('Y-m-d'))
                        ->orWhereDate($field, $today->copy()->addDays(30)->format('Y-m-d'));
                }
            })
            ->get();

        foreach ($vehicles as $vehicle) {
            $expiringDetails = [];
            
            foreach (['vehiclelicenseexpiry', 'roadworthinessexpiry', 'insuranceexpiry', 'hackneypermitexpiry', 'statecarriagepermitexpiry', 'hackneydutypermitexpiry', 'localgovernmentpermitexpiry'] as $field) {
                if (in_array($vehicle->{$field}, [
                    $today->copy()->addDays(1)->format('Y-m-d'),
                    $today->copy()->addDays(5)->format('Y-m-d'),
                    $today->copy()->addDays(10)->format('Y-m-d'),
                    $today->copy()->addDays(15)->format('Y-m-d'),
                    $today->copy()->addDays(20)->format('Y-m-d'),
                    $today->copy()->addDays(30)->format('Y-m-d')
                ])) {
                    $expiringDetails[$field] = $vehicle->{$field};
                }
            }

            if (!empty($expiringDetails)) {
                \Log::info("Notifying user ID: {$vehicle->user->id} for vehicle ID: {$vehicle->id} with expiring fields: " . implode(', ', array_keys($expiringDetails)));
                
                try {
                    Notification::send($vehicle->user, new ExpiryNotification($vehicle, $expiringDetails));
                    \Log::info("Notification sent successfully for vehicle ID: {$vehicle->id}");
                } catch (\Exception $e) {
                    \Log::error("Failed to send notification for vehicle ID: {$vehicle->id}, Error: {$e->getMessage()}");
                }
            }
        }

        $this->info('Notification process completed.');
    }
}
