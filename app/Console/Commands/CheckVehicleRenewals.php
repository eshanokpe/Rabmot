<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AddVehicleRenewal;
use App\Models\User;
use App\Notifications\VehicleRenewalReminderNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CheckVehicleRenewals extends Command
{
    protected $signature = 'check:vehicle-renewals';
    protected $description = 'Check and notify about expiring vehicle documents';
    
    // Days before expiry to send notifications
    protected $notificationDays = [1, 5, 10, 15, 30];
    
    // Document fields to check with their display names
    protected $documentTypes = [
        'vehicle_license' => [
            'name' => 'Vehicle License',
            'grace_period' => 30 // days after expiry
        ],
        'road_worthiness' => [
            'name' => 'Road Worthiness',
            'grace_period' => 14
        ],
        'insurance' => [
            'name' => 'Insurance',
            'grace_period' => 7
        ],
        'hackney_permit' => [
            'name' => 'Hackney Permit',
            'grace_period' => 30
        ],
        'state_carriage_permit' => [
            'name' => 'State Carriage Permit',
            'grace_period' => 30
        ],
        'mid_year_permit' => [
            'name' => 'Mid-Year Permit',
            'grace_period' => 15
        ],
        'local_government_permit' => [
            'name' => 'Local Government Permit',
            'grace_period' => 30
        ]
    ];

    public function handle()
    {
        $startTime = microtime(true);
        $processed = 0;
        $notificationsSent = 0;
        $errors = 0;

        $this->info('Starting vehicle document expiry checks...');
        Log::info('[VehicleRenewal] Process started');

        try {
            AddVehicleRenewal::with(['user', 'vehicleTypeInfo'])
                ->whereHas('user')
                ->chunk(200, function ($vehicles) use (&$processed, &$notificationsSent, &$errors) {
                    foreach ($vehicles as $vehicle) {
                        $processed++;
                        foreach ($this->documentTypes as $field => $config) {
                            if (empty($vehicle->$field)) {
                                continue;
                            }

                            try {
                                if ($this->shouldNotify($vehicle->$field, $config['grace_period'])) {
                                    $this->sendDocumentNotification($vehicle, $field, $config);
                                    $notificationsSent++;
                                }
                            } catch (\Exception $e) {
                                $errors++;
                                Log::error("[VehicleRenewal] Error processing {$field} for vehicle {$vehicle->id}", [
                                    'error' => $e->getMessage(),
                                    'vehicle' => $vehicle->id,
                                    'user' => $vehicle->user_email
                                ]);
                            }
                        }
                    }
                });

            $executionTime = round(microtime(true) - $startTime, 2);
            
            $this->info("Process completed. Vehicles: {$processed}, Notifications: {$notificationsSent}, Errors: {$errors}");
            $this->info("Execution time: {$executionTime}s");
            
            Log::info('[VehicleRenewal] Process completed', [
                'vehicles_processed' => $processed,
                'notifications_sent' => $notificationsSent,
                'errors' => $errors,
                'duration_seconds' => $executionTime
            ]);

        } catch (\Exception $e) {
            Log::critical('[VehicleRenewal] Process failed', ['error' => $e->getMessage()]);
            $this->error('Process failed: ' . $e->getMessage());
        }
    }

    protected function shouldNotify($expiryDate, $gracePeriod)
    {
        $expiry = Carbon::parse($expiryDate);
        $today = Carbon::today();
        
        // Check if in grace period (after expiry but within grace days)
        if ($today->between($expiry, $expiry->copy()->addDays($gracePeriod))) {
            return true;
        }
        
        // Check if approaching expiry (within notification days)
        $daysUntilExpiry = $today->diffInDays($expiry, false);
        return in_array($daysUntilExpiry, $this->notificationDays);
    }

    protected function sendDocumentNotification($vehicle, $field, $config)
    {
        $expiryDate = Carbon::parse($vehicle->$field);
        $today = Carbon::today();
        $daysRemaining = $today->diffInDays($expiryDate, false);
        
        $user = $vehicle->user ?? User::where('email', $vehicle->user_email)->first();
        
        if (!$user) {
            Log::warning("[VehicleRenewal] User not found", ['email' => $vehicle->user_email]);
            return false;
        }

        $status = $this->determineStatus($daysRemaining, $config['grace_period']);
        $message = $this->createMessage($config['name'], $daysRemaining, $status);

        $user->notify(new VehicleRenewalReminderNotification(
            $message,
            $config['name'],
            $daysRemaining,
            $status,
            $expiryDate->format('Y-m-d'),
            $vehicle->id
        ));

        Log::info("[VehicleRenewal] Notification sent", [
            'user' => $user->id,
            'vehicle' => $vehicle->id,
            'document' => $config['name'],
            'status' => $status,
            'days_remaining' => $daysRemaining
        ]);

        return true;
    }

    protected function determineStatus($daysRemaining, $gracePeriod)
    {
        if ($daysRemaining < 0) {
            return (abs($daysRemaining) <= $gracePeriod) ? 'grace_period' : 'expired';
        }
        return $daysRemaining == 0 ? 'expiring_today' : 'expiring_soon';
    }

    protected function createMessage($docName, $daysRemaining, $status)
    {
        switch ($status) {
            case 'grace_period':
                $daysOverdue = abs($daysRemaining);
                return "URGENT: Your {$docName} expired {$daysOverdue} day(s) ago! Renew within grace period to avoid penalties.";
            
            case 'expired':
                return "ACTION REQUIRED: Your {$docName} has expired! Immediate renewal needed.";
            
            case 'expiring_today':
                return "URGENT: Your {$docName} expires today! Renew immediately.";
            
            default:
                return "Reminder: Your {$docName} will expire in {$daysRemaining} days.";
        }
    }
}