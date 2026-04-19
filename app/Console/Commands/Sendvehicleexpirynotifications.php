<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\AddVehicleRenewal;
use App\Models\User;
use App\Models\Notifications; 
use App\Mail\VehicleExpiryMail;
use Carbon\Carbon; 

class SendVehicleExpiryNotifications extends Command
{
    /**. 
     * The name and signature of the console command.
     */
    protected $signature = 'notify:vehicle-expiry 
                            {--dry-run : Run without actually sending notifications}';

    /**
     * The console command description.
     */
    protected $description = 'Send in-app and email notifications for vehicle documents expiring in 15, 7, and 1 day(s)';

    /**
     * Notification thresholds in days.
     */
    protected array $thresholds = [1, 7, 15];

    /**
     * Document fields and their human-readable labels.
     */
    protected array $documentFields = [
        'vehiclelicenseexpiry'        => 'Vehicle License',
        'roadworthinessexpiry'        => 'Road Worthiness',
        'insuranceexpiry'             => 'Insurance',
        'hackneypermitexpiry'         => 'Hackney Permit',
        'statecarriagepermitexpiry'   => 'State Carriage Permit',
        'hackneydutypermitexpiry'     => 'Mid-Year (Hackney Duty) Permit',
        'localgovernmentpermitexpiry' => 'Local Government Permit',
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $isDryRun = $this->option('dry-run');
        $today    = Carbon::today();

        $this->info('=================================================');
        $this->info('  Vehicle Expiry Notification Job — ' . $today->toDateString());
        $this->info('=================================================');

        if ($isDryRun) {
            $this->warn('  [DRY RUN] No notifications will actually be sent.');
        }

        $vehicles = AddVehicleRenewal::all();

        if ($vehicles->isEmpty()) {
            $this->info('No vehicles found. Exiting.');
            return self::SUCCESS;
        }

        $totalNotificationsSent = 0;

        foreach ($vehicles as $vehicle) {
            $user = User::find($vehicle->user_id) ?? User::where('email', $vehicle->user_email)->first();

            if (! $user) {
                $this->warn("  Skipping vehicle ID {$vehicle->id}: owner not found.");
                continue;
            }

            foreach ($this->documentFields as $field => $label) {
                if (empty($vehicle->$field)) {
                    continue; // No expiry date stored — skip
                }

                $expiryDate    = Carbon::parse($vehicle->$field)->startOfDay();
                $daysRemaining = $today->diffInDays($expiryDate, false); // negative = already expired

                if (! in_array((int) $daysRemaining, $this->thresholds, true)) {
                    continue; // Not a threshold day — skip
                }

                $daysRemaining = (int) $daysRemaining;

                $this->line("  → [{$user->email}] {$label} for plate <{$vehicle->platenumber}> expires in {$daysRemaining} day(s).");

                if ($isDryRun) {
                    continue;
                }

                // Check for duplicate: skip if already notified today for the same doc & threshold
                $alreadySent = Notifications::where('user_id', $user->id)
                    ->where('vehicle_id', $vehicle->id)
                    ->where('document_field', $field)
                    ->where('days_threshold', $daysRemaining)
                    ->whereDate('created_at', $today->toDateString())
                    ->exists();

                if ($alreadySent) {
                    $this->line("    [SKIP] Notification already sent today for this document & threshold.");
                    continue;
                }

                try {
                    // 1. In-app notification
                    $this->createInAppNotification($user, $vehicle, $label, $field, $daysRemaining, $expiryDate);

                    // 2. Email notification
                    Mail::to($user->email)->send(
                        new VehicleExpiryMail($user, $vehicle, $label, $daysRemaining, $expiryDate)
                    );

                    $totalNotificationsSent++;
                    $this->info("    [OK] In-app + email sent.");

                } catch (\Throwable $e) {
                    $this->error("    [ERROR] Failed: {$e->getMessage()}");
                    Log::error('VehicleExpiryNotification failed', [
                        'user_id'    => $user->id,
                        'vehicle_id' => $vehicle->id,
                        'field'      => $field,
                        'error'      => $e->getMessage(),
                    ]);
                }
            }
        }

        $this->info('');
        $this->info("✓ Done. Total notifications dispatched: {$totalNotificationsSent}");

        return self::SUCCESS;
    }

    /**
     * Persist an in-app notification record.
     */
    protected function createInAppNotification(
        User              $user,
        AddVehicleRenewal $vehicle,
        string            $label,
        string            $field,
        int               $daysRemaining,
        Carbon            $expiryDate
    ): void {
        $urgency = $this->urgencyLabel($daysRemaining);

        $title = "{$urgency} – {$label} Expiring Soon";

        $message = "Your {$label} for vehicle <strong>{$vehicle->platenumber}</strong>"
            . ($vehicle->vehiclemake ? " ({$vehicle->vehiclemake})" : '')
            . " will expire on <strong>{$expiryDate->format('d M, Y')}</strong> "
            . "— that is <strong>{$daysRemaining} day" . ($daysRemaining > 1 ? 's' : '') . "</strong> from today. "
            . "Please renew it promptly to avoid penalties.";

        Notifications::create([
            'user_id'        => $user->id,
            'user_email'     => $user->email,
            'fullname'       => $user->name ?? $user->fullname ?? '',
            'userType'       => 'user',
            'type'           => 'vehicle_expiry',
            'title'          => $title,
            'message'        => $message,
            'vehicle_id'     => $vehicle->id,
            'document_field' => $field,
            'days_threshold' => $daysRemaining,
            'read_at'        => null,
        ]);
    }

    /**
     * Return a urgency prefix string based on days remaining.
     */
    protected function urgencyLabel(int $days): string
    {
        return match ($days) {
            1  => '🔴 URGENT',
            7  => '🟠 REMINDER',
            15 => '🟡 HEADS UP',
            default => 'NOTICE',
        };
    }
}
