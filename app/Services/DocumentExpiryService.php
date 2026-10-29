<?php

namespace App\Services;

use App\Mail\VehicleExpiryMail;
use App\Models\AddVehicleOwnership;
use App\Models\AddVehicleRenewal;
use App\Models\DocumentReminder;
use App\Support\PhoneNumber;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * One place that knows which records carry document expiry dates, how to read
 * them, and how to word the WhatsApp reminder for each document.
 */
class DocumentExpiryService
{
    public const STATUS_EXPIRED = 'expired';
    public const STATUS_WEEK = 'week';    // 0-7 days left
    public const STATUS_MONTH = 'month';  // 8 days up to the alert window
    public const STATUS_VALID = 'valid';
    public const STATUS_NONE = 'none';    // no (or unreadable) expiry date

    public const DOCUMENT_LABELS = [
        'vehiclelicenseexpiry'        => 'Vehicle License',
        'insuranceexpiry'             => 'Insurance',
        'roadworthinessexpiry'        => 'Road Worthiness',
        'hackneypermitexpiry'         => 'Hackney Permit',
        'statecarriagepermitexpiry'   => 'State Carriage Permit',
        'hackneydutypermitexpiry'     => 'Mid-Year (Hackney Duty) Permit',
        'localgovernmentpermitexpiry' => 'Local Government Permit',
    ];

    /**
     * Records that carry expiry dates. Each document field is one row on the
     * Document Expiry page.
     */
    public const CHANNELS = ['email', 'sms', 'whatsapp'];

    public const NO_EMAIL = 'No valid email address on record';

    public const SOURCES = [
        'vehicle_renewal' => [
            'label'      => 'Vehicle Renewal',
            'model'      => AddVehicleRenewal::class,
            'name'       => ['ownerfullname'],
            'phone'      => 'ownersphonenumber',
            'email'      => ['owneremail', 'emailAddress'],
            'view_route' => 'admin.vehicle.renewals.view',
            'fields'     => [
                'vehiclelicenseexpiry', 'insuranceexpiry', 'roadworthinessexpiry', 'hackneypermitexpiry',
                'statecarriagepermitexpiry', 'hackneydutypermitexpiry', 'localgovernmentpermitexpiry',
            ],
        ],
        'vehicle_ownership' => [
            'label'      => 'Change of Ownership',
            'model'      => AddVehicleOwnership::class,
            'name'       => ['ownerfullname', 'ownersfullname'],
            'phone'      => 'phonenumber',
            'email'      => ['ownersemail', 'emailaddress'],
            'view_route' => 'admin.changeOfOwnership.view',
            'fields'     => [
                'vehiclelicenseexpiry', 'insuranceexpiry', 'roadworthinessexpiry', 'hackneypermitexpiry',
                'statecarriagepermitexpiry', 'localgovernmentpermitexpiry',
            ],
        ],
    ];

    public function alertWindowDays(): int
    {
        return max(7, (int) config('whatsapp_reminders.alert_window_days', 30));
    }

    /**
     * Every tracked document across all sources.
     */
    public function allDocuments(): Collection
    {
        $documents = collect();

        foreach (self::SOURCES as $source => $config) {
            foreach ($config['model']::all() as $record) {
                $documents = $documents->concat($this->documentsFor($source, $record));
            }
        }

        return $documents;
    }

    /**
     * The documents on a single record.
     */
    public function documentsFor(string $source, Model $record): Collection
    {
        $config = self::SOURCES[$source];
        $today = Carbon::today();
        $window = $this->alertWindowDays();

        $ownerName = collect($config['name'])->map(fn ($attr) => trim((string) $record->$attr))->first(fn ($name) => $name !== '');
        $rawPhone = $record->{$config['phone']};
        $phone = PhoneNumber::normalize($rawPhone);
        // The owner's email on the record; failing that, the customer's own
        // account email (never an agent's or admin's — they only added it).
        $emailAttrs = $config['email'];
        if (strtolower((string) $record->userType) === 'user') {
            $emailAttrs[] = 'user_email';
        }
        $email = collect($emailAttrs)
            ->map(fn ($attr) => trim((string) $record->$attr))
            ->first(fn ($address) => filter_var($address, FILTER_VALIDATE_EMAIL) !== false);

        return collect($config['fields'])->map(function ($field) use ($source, $config, $record, $today, $window, $ownerName, $rawPhone, $phone, $email) {
            $expiryDate = $this->parseDate($record->$field);
            $daysRemaining = $expiryDate ? (int) $today->diffInDays($expiryDate, false) : null;

            return [
                'key'            => "{$source}:{$record->id}:{$field}",
                'source'         => $source,
                'source_label'   => $config['label'],
                'record_id'      => $record->id,
                'record'         => $record,
                'view_url'       => route($config['view_route'], encrypt($record->id)),
                'owner_name'     => $ownerName,
                'raw_phone'      => $rawPhone,
                'phone'          => $phone,
                'email'          => $email,
                'plate'          => $record->platenumber,
                'vehicle'        => trim($record->vehiclemake . ' ' . $record->vehiclemodel),
                'field'          => $field,
                'label'          => self::DOCUMENT_LABELS[$field],
                'expiry_date'    => $expiryDate,
                'days_remaining' => $daysRemaining,
                'status'         => $this->statusFor($daysRemaining, $window),
                'last_reminders' => [],
            ];
        });
    }

    public function statusFor(?int $daysRemaining, int $window): string
    {
        return match (true) {
            $daysRemaining === null => self::STATUS_NONE,
            $daysRemaining < 0      => self::STATUS_EXPIRED,
            $daysRemaining <= 7     => self::STATUS_WEEK,
            $daysRemaining <= $window => self::STATUS_MONTH,
            default                 => self::STATUS_VALID,
        };
    }

    /**
     * Expired or expiring within the alert window — the documents a reminder
     * can be sent for.
     */
    public function needsReminder(array $document): bool
    {
        return in_array($document['status'], [self::STATUS_EXPIRED, self::STATUS_WEEK, self::STATUS_MONTH], true);
    }

    /**
     * Fill in each document's most recent reminder on every channel, as
     * $document['last_reminders']['email' | 'sms' | 'whatsapp'].
     */
    public function attachLastReminders(Collection $documents): Collection
    {
        if ($documents->isEmpty()) {
            return $documents;
        }

        $reminders = DocumentReminder::query()
            ->where(function ($query) use ($documents) {
                foreach ($documents->groupBy('source') as $source => $group) {
                    $query->orWhere(fn ($q) => $q->where('source', $source)->whereIn('record_id', $group->pluck('record_id')->unique()));
                }
            })
            ->latest()
            ->orderByDesc('id')
            ->get()
            ->groupBy(fn ($reminder) => "{$reminder->source}:{$reminder->record_id}:{$reminder->document_field}");

        return $documents->map(function ($document) use ($reminders) {
            $document['last_reminders'] = collect($reminders->get($document['key'], []))
                ->unique('channel')
                ->keyBy('channel')
                ->all();

            return $document;
        });
    }

    /**
     * Email the owner now and log the attempt. Returns the log entry.
     * $reminderPoint is set for the automatic daily email (null when an admin sends it).
     */
    public function sendEmail(array $document, $admin, ?int $reminderPoint = null): DocumentReminder
    {
        if (!$document['email']) {
            return $this->log($document, 'email', 'failed', null, null, $admin, self::NO_EMAIL, $reminderPoint);
        }

        try {
            Mail::to($document['email'])->send(new VehicleExpiryMail(
                $document['owner_name'],
                $document['record'],
                $document['label'],
                $document['days_remaining'],
                $document['expiry_date']
            ));
        } catch (\Throwable $e) {
            Log::error("Expiry email failed for {$document['key']}: {$e->getMessage()}");

            return $this->log($document, 'email', 'failed', $document['email'], null, $admin, 'Email could not be sent: ' . $e->getMessage(), $reminderPoint);
        }

        return $this->log($document, 'email', 'sent', $document['email'], null, $admin, null, $reminderPoint);
    }

    /**
     * The automatic reminder point a document is due for today (e.g. 30, 15,
     * 7 or 1 days, or 0 for "expired"), or null if none. A missed point is
     * caught up: a document found with 5 days left is due its 7-day email.
     */
    public function dueReminderPoint(array $document): ?int
    {
        $days = $document['days_remaining'];
        if ($days === null) {
            return null;
        }

        if ($days < 0) {
            $withinDays = (int) config('whatsapp_reminders.automatic_expired_within_days', 7);

            return config('whatsapp_reminders.automatic_expired_email') && -$days <= $withinDays ? 0 : null;
        }

        $points = collect(config('whatsapp_reminders.automatic_points', [30, 15, 7, 1]))->sort()->values();

        return $points->first(fn ($point) => $point >= $days);
    }

    /**
     * Whether the automatic email for this point was already sent for this
     * expiry date (or can never be sent because there is no address). Other
     * failures, such as the mail server being down, are retried next run.
     */
    public function automaticReminderHandled(array $document, int $reminderPoint): bool
    {
        return DocumentReminder::where('source', $document['source'])
            ->where('record_id', $document['record_id'])
            ->where('document_field', $document['field'])
            ->where('channel', 'email')
            ->where('reminder_point', $reminderPoint)
            ->whereDate('expiry_date', $document['expiry_date'])
            ->where(fn ($q) => $q->where('status', 'sent')->orWhere('error_message', self::NO_EMAIL))
            ->exists();
    }

    /**
     * Text the owner now through Termii and log the attempt. Returns the log entry.
     */
    public function sendSms(array $document, $admin, ?string $message = null): DocumentReminder
    {
        $message = trim((string) $message) ?: $this->buildMessage($document);

        if (!$document['phone']) {
            return $this->log($document, 'sms', 'failed', $document['raw_phone'] ?: '—', $message, $admin, 'No valid phone number on record');
        }

        $error = app(TermiiSmsSender::class)->send($document['phone'], $message);

        return $this->log($document, 'sms', $error ? 'failed' : 'sent', $document['phone'], $message, $admin, $error);
    }

    /**
     * Log a WhatsApp reminder (the admin sends it from the wa.me chat).
     */
    public function logWhatsapp(array $document, $admin, string $message): DocumentReminder
    {
        return $this->log($document, 'whatsapp', 'sent', $document['phone'], $message, $admin);
    }

    private function log(array $document, string $channel, string $status, ?string $recipient, ?string $message, $admin, ?string $error = null, ?int $reminderPoint = null): DocumentReminder
    {
        $automaticLabel = $reminderPoint === null ? null
            : ($reminderPoint === 0 ? 'Automatic (expired notice)' : "Automatic ({$reminderPoint}-day reminder)");

        return DocumentReminder::create([
            'source' => $document['source'],
            'record_id' => $document['record_id'],
            'document_field' => $document['field'],
            'channel' => $channel,
            'status' => $status,
            'reminder_point' => $reminderPoint,
            'expiry_date' => $document['expiry_date'],
            'recipient' => $recipient ?? '—',
            'message' => $message,
            'error_message' => $error ? mb_substr($error, 0, 255) : null,
            'admin_id' => $admin?->id,
            'admin_name' => $admin?->name ?? $automaticLabel,
        ]);
    }

    public function buildMessage(array $document): string
    {
        $clientName = $document['owner_name'] ?: optional($document['record']->user ?? null)->fullname ?: 'there';
        $link = rtrim((string) config('whatsapp_reminders.renewal_link'), '/');
        $date = $document['expiry_date']->format('F j, Y');

        if ($document['status'] === self::STATUS_EXPIRED) {
            return "Hi {$clientName}, this is a reminder that your {$document['label']} expired on {$date}. "
                . "Please reach out to us or visit {$link} to renew it as soon as possible.";
        }

        return "Hi {$clientName}, this is a reminder that your {$document['label']} is expiring on {$date}. "
            . "Please reach out to us or visit {$link} to begin your renewal before it expires.";
    }

    public function whatsappUrl(string $phone, string $message): string
    {
        return PhoneNumber::whatsappUrl($phone, $message);
    }

    /**
     * Look up one document by its source, record and field.
     */
    public function findDocument(string $source, int $recordId, string $field): ?array
    {
        $config = self::SOURCES[$source] ?? null;
        if (!$config || !in_array($field, $config['fields'], true)) {
            return null;
        }

        $record = $config['model']::find($recordId);

        return $record ? $this->documentsFor($source, $record)->firstWhere('field', $field) : null;
    }

    private function parseDate($value): ?Carbon
    {
        if (empty($value)) {
            return null;
        }

        try {
            return Carbon::parse($value)->startOfDay();
        } catch (\Throwable $e) {
            return null;
        }
    }
}
