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
        // dd($today->copy()->addDays(5)->format('Y-m-d'));

        // Get vehicles with expiry dates 30 or 15 days away
        $vehicles = AddVehicleRenewal::with('user')
        ->where(function ($query) use ($today) {
            $query->whereDate('vehiclelicenseexpiry', $today->copy()->addDays(5)->format('Y-m-d'))
                ->orWhereDate('vehiclelicenseexpiry', $today->copy()->addDays(10)->format('Y-m-d'))
                ->orWhereDate('vehiclelicenseexpiry', $today->copy()->addDays(15)->format('Y-m-d'))
                ->orWhereDate('vehiclelicenseexpiry', $today->copy()->addDays(20)->format('Y-m-d'))
                ->orWhereDate('vehiclelicenseexpiry', $today->copy()->addDays(30)->format('Y-m-d'))

                ->orWhereDate('roadworthinessexpiry', $today->copy()->addDays(5)->format('Y-m-d'))
                ->orWhereDate('roadworthinessexpiry', $today->copy()->addDays(10)->format('Y-m-d'))
                ->orWhereDate('roadworthinessexpiry', $today->copy()->addDays(15)->format('Y-m-d'))
                ->orWhereDate('roadworthinessexpiry', $today->copy()->addDays(20)->format('Y-m-d'))
                ->orWhereDate('roadworthinessexpiry', $today->copy()->addDays(30)->format('Y-m-d'))
                
                ->orWhereDate('insuranceexpiry', $today->copy()->addDays(5)->format('Y-m-d'))
                ->orWhereDate('insuranceexpiry', $today->copy()->addDays(10)->format('Y-m-d'))
                ->orWhereDate('insuranceexpiry', $today->copy()->addDays(15)->format('Y-m-d'))
                ->orWhereDate('insuranceexpiry', $today->copy()->addDays(20)->format('Y-m-d'))
                ->orWhereDate('insuranceexpiry', $today->copy()->addDays(30)->format('Y-m-d'))

                ->orWhereDate('hackneypermitexpiry', $today->copy()->addDays(5)->format('Y-m-d'))
                ->orWhereDate('hackneypermitexpiry', $today->copy()->addDays(10)->format('Y-m-d'))
                ->orWhereDate('hackneypermitexpiry', $today->copy()->addDays(15)->format('Y-m-d'))
                ->orWhereDate('hackneypermitexpiry', $today->copy()->addDays(20)->format('Y-m-d'))
                ->orWhereDate('hackneypermitexpiry', $today->copy()->addDays(30)->format('Y-m-d'))

                ->orWhereDate('statecarriagepermitexpiry', $today->copy()->addDays(5)->format('Y-m-d'))
                ->orWhereDate('statecarriagepermitexpiry', $today->copy()->addDays(10)->format('Y-m-d'))
                ->orWhereDate('statecarriagepermitexpiry', $today->copy()->addDays(15)->format('Y-m-d'))
                ->orWhereDate('statecarriagepermitexpiry', $today->copy()->addDays(20)->format('Y-m-d'))
                ->orWhereDate('statecarriagepermitexpiry', $today->copy()->addDays(30)->format('Y-m-d'))

                ->orWhereDate('hackneydutypermitexpiry', $today->copy()->addDays(5)->format('Y-m-d'))
                ->orWhereDate('hackneydutypermitexpiry', $today->copy()->addDays(10)->format('Y-m-d'))
                ->orWhereDate('hackneydutypermitexpiry', $today->copy()->addDays(15)->format('Y-m-d'))
                ->orWhereDate('hackneydutypermitexpiry', $today->copy()->addDays(20)->format('Y-m-d'))
                ->orWhereDate('hackneydutypermitexpiry', $today->copy()->addDays(30)->format('Y-m-d'))

                ->orWhereDate('localgovernmentpermitexpiry', $today->copy()->addDays(5)->format('Y-m-d'))
                ->orWhereDate('localgovernmentpermitexpiry', $today->copy()->addDays(10)->format('Y-m-d'))
                ->orWhereDate('localgovernmentpermitexpiry', $today->copy()->addDays(15)->format('Y-m-d'))
                ->orWhereDate('localgovernmentpermitexpiry', $today->copy()->addDays(20)->format('Y-m-d'))
                ->orWhereDate('localgovernmentpermitexpiry', $today->copy()->addDays(30)->format('Y-m-d'))
                ;

        })
        ->get();
        // dd($vehicles->first()->vehiclelicenseexpiry);

        foreach ($vehicles as $vehicle) {

            \Log::info("Attempting to notify user ID: {$vehicle->user->id} for vehicle ID: {$vehicle->id}");
            try {
                Notification::send($vehicle->user, new ExpiryNotification($vehicle));
                \Log::info("Notification sent successfully for vehicle ID: {$vehicle->id}");
            } catch (\Exception $e) {
                \Log::error("Failed to send notification for vehicle ID: {$vehicle->id}, Error: {$e->getMessage()}");
            }
        }
        

        $this->info('Notification sent successfully.');
    }
}
