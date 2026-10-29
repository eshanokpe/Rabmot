<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notifications;
use App\Models\User;
use App\Services\DocumentExpiryService;
use Carbon\Carbon;

class SendVehicleExpiryNotifications extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'notify:vehicle-expiry
                            {--dry-run : List what would be sent without sending anything}';

    /**
     * The console command description.
     */
    protected $description = 'Email vehicle owners when a document reaches an expiry reminder point (30, 15, 7 and 1 days by default), plus one notice after it expires';

    /**
     * Execute the console command.
     */
    public function handle(DocumentExpiryService $service): int
    {
        $isDryRun = $this->option('dry-run');
        $points = implode(', ', config('whatsapp_reminders.automatic_points'));

        $this->info('=================================================');
        $this->info('  Vehicle Expiry Reminders — ' . Carbon::today()->toDateString());
        $this->info("  Reminder points (days): {$points}");
        $this->info('=================================================');

        if ($isDryRun) {
            $this->warn('  [DRY RUN] Nothing will actually be sent.');
        }

        $sent = 0;
        $failed = 0;

        foreach ($service->allDocuments() as $document) {
            $point = $service->dueReminderPoint($document);

            if ($point === null || $service->automaticReminderHandled($document, $point)) {
                continue;
            }

            $when = $point === 0 ? 'expired notice' : "{$point}-day reminder";
            $this->line("  → [{$document['plate']}] {$document['label']} ({$document['days_remaining']} days) — {$when} to " . ($document['email'] ?: 'no email'));

            if ($isDryRun) {
                continue;
            }

            $log = $service->sendEmail($document, null, $point);

            if ($log->status === 'sent') {
                $sent++;
                $this->info('    [OK] Email sent.');
            } else {
                $failed++;
                $this->error("    [FAILED] {$log->error_message}");
            }

            $this->createInAppNotification($document, $point);
        }

        $this->info('');
        $this->info("✓ Done. Emails sent: {$sent}, failed: {$failed}");

        return self::SUCCESS;
    }

    /**
     * In-app notification for vehicles a customer added to their own account
     * (once per reminder point).
     */
    protected function createInAppNotification(array $document, int $point): void
    {
        $record = $document['record'];

        if ($document['source'] !== 'vehicle_renewal' || strtolower((string) $record->userType) !== 'user') {
            return;
        }

        $user = User::find($record->user_id);
        if (!$user || $user->email !== $record->user_email) {
            return;
        }

        $alreadyNotified = Notifications::where('user_id', $user->id)
            ->where('vehicle_id', $record->id)
            ->where('document_field', $document['field'])
            ->where('days_threshold', $point)
            ->exists();

        if ($alreadyNotified) {
            return;
        }

        $days = $document['days_remaining'];
        $vehicle = "<strong>{$record->platenumber}</strong>" . ($record->vehiclemake ? " ({$record->vehiclemake})" : '');
        $date = $document['expiry_date']->format('d M, Y');

        if ($point === 0) {
            $title = "🔴 EXPIRED – {$document['label']}";
            $message = "Your {$document['label']} for vehicle {$vehicle} expired on <strong>{$date}</strong>. "
                . 'Please renew it as soon as possible to avoid penalties.';
        } else {
            $title = "{$this->urgencyLabel($days)} – {$document['label']} Expiring Soon";
            $message = "Your {$document['label']} for vehicle {$vehicle} will expire on <strong>{$date}</strong> "
                . "— that is <strong>{$days} day" . ($days === 1 ? '' : 's') . '</strong> from today. '
                . 'Please renew it promptly to avoid penalties.';
        }

        Notifications::create([
            'user_id'        => $user->id,
            'user_email'     => $user->email,
            'fullname'       => $user->fullname ?? '',
            'userType'       => 'user',
            'type'           => 'vehicle_expiry',
            'title'          => $title,
            'message'        => $message,
            'vehicle_id'     => $record->id,
            'document_field' => $document['field'],
            'days_threshold' => $point,
            'read_at'        => null,
        ]);
    }

    /**
     * Return a urgency prefix string based on days remaining.
     */
    protected function urgencyLabel(int $days): string
    {
        return match (true) {
            $days <= 1  => '🔴 URGENT',
            $days <= 7  => '🟠 REMINDER',
            $days <= 15 => '🟡 HEADS UP',
            default     => 'NOTICE',
        };
    }
}
