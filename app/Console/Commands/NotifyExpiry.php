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
    protected $description = 'Notify users about upcoming and expired vehicle documents';

    public function handle()
    {
        $today = Carbon::today();
        $notificationIntervals = [1, 5, 10, 15, 20, 30];
        
        $expiryFields = [
            'vehiclelicenseexpiry', 
            'roadworthinessexpiry', 
            'insuranceexpiry',
            'hackneypermitexpiry',
            'statecarriagepermitexpiry',
            'hackneydutypermitexpiry',
            'localgovernmentpermitexpiry'
        ];

        // Get vehicles with documents expiring soon or already expired
        $vehicles = AddVehicleRenewal::with(['user' => function($query) {
                $query->whereNotNull('email'); // Only users with email
            }])
            ->where(function ($query) use ($today, $notificationIntervals, $expiryFields) {
                foreach ($expiryFields as $field) {
                    // Check for documents expiring in the specified intervals
                    foreach ($notificationIntervals as $days) {
                        $query->orWhereDate($field, $today->copy()->addDays($days));
                    }
                    
                    // Check for documents that expired today or before
                    $query->orWhereDate($field, '<=', $today);
                    
                    // Check for documents expiring today
                    $query->orWhereDate($field, $today);
                }
            })
            ->whereHas('user') // Only vehicles with associated users
            ->get();

        $notifiedCount = 0;
        $errorCount = 0;

        foreach ($vehicles as $vehicle) {
            $expiringDetails = [];
            
            foreach ($expiryFields as $field) {
                if (empty($vehicle->{$field})) continue;
                
                $expiryDate = Carbon::parse($vehicle->{$field});
                $daysUntilExpiry = $today->diffInDays($expiryDate, false);

                // Check if within notification range or expired
                if (in_array($daysUntilExpiry, $notificationIntervals) || $daysUntilExpiry <= 0) {
                    $status = $daysUntilExpiry < 0 ? 'expired' : 
                              ($daysUntilExpiry == 0 ? 'expiring_today' : 'expiring_soon');
                    
                    $expiringDetails[$field] = [
                        'date' => $vehicle->{$field},
                        'days_remaining' => $daysUntilExpiry,
                        'status' => $status,
                        'field_name' => $this->getFieldDisplayName($field)
                    ];
                }
            }

            if (!empty($expiringDetails) && $vehicle->user) {
                try {
                    Notification::send(
                        $vehicle->user, 
                        new ExpiryNotification($vehicle, $expiringDetails)
                    );
                    $notifiedCount++;
                    
                    \Log::info("Sent expiry notification to user {$vehicle->user->id} for vehicle {$vehicle->id}", [
                        'expiring_details' => $expiringDetails
                    ]);
                } catch (\Exception $e) {
                    $errorCount++;
                    \Log::error("Failed to notify user {$vehicle->user->id} for vehicle {$vehicle->id}", [
                        'error' => $e->getMessage(),
                        'expiring_details' => $expiringDetails
                    ]);
                }
            }
        }

        $this->info("Notification process completed. Notified: {$notifiedCount}, Errors: {$errorCount}");
        \Log::info("Expiry notification job completed", [
            'notified_count' => $notifiedCount,
            'error_count' => $errorCount,
            'total_vehicles_processed' => $vehicles->count()
        ]);
    }

    /**
     * Get display name for expiry fields
     */
    protected function getFieldDisplayName($field): string
    {
        $names = [
            'vehiclelicenseexpiry' => 'Vehicle License',
            'roadworthinessexpiry' => 'Road Worthiness',
            'insuranceexpiry' => 'Insurance',
            'hackneypermitexpiry' => 'Hackney Permit',
            'statecarriagepermitexpiry' => 'State Carriage Permit',
            'hackneydutypermitexpiry' => 'Hackney Duty Permit',
            'localgovernmentpermitexpiry' => 'Local Government Permit'
        ];

        return $names[$field] ?? ucfirst(str_replace('expiry', '', $field));
    }
}