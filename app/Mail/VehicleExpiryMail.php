<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VehicleExpiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public ?string $recipientName;
    public Model   $vehicle;   // AddVehicleRenewal or AddVehicleOwnership
    public string  $documentLabel;
    public int     $daysRemaining; // negative once the document has expired
    public Carbon  $expiryDate;
    public string  $urgencyColor;
    public string  $urgencyText;

    public function __construct(
        ?string $recipientName,
        Model   $vehicle,
        string  $documentLabel,
        int     $daysRemaining,
        Carbon  $expiryDate
    ) {
        $this->recipientName = $recipientName;
        $this->vehicle       = $vehicle;
        $this->documentLabel = $documentLabel;
        $this->daysRemaining = $daysRemaining;
        $this->expiryDate    = $expiryDate;

        [$this->urgencyColor, $this->urgencyText] = $this->resolveUrgency($daysRemaining);
    }

    public function envelope(): Envelope
    {
        $days = $this->daysRemaining;

        $subject = match (true) {
            $days < 0   => "⚠️ Your {$this->documentLabel} has expired",
            $days === 0 => "⚠️ URGENT: Your {$this->documentLabel} expires TODAY!",
            $days === 1 => "⚠️ URGENT: Your {$this->documentLabel} expires TOMORROW!",
            default     => "⏰ Reminder: {$this->documentLabel} expires in {$days} days",
        };

        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.vehicle-expiry',
        );
    }

    public function attachments(): array
    {
        return [];
    }

    protected function resolveUrgency(int $days): array
    {
        return match (true) {
            $days < 0   => ['#DC2626', 'Expired – Renew Now'],
            $days <= 1  => ['#DC2626', 'URGENT – Action Required Today'],
            $days <= 7  => ['#D97706', 'Reminder – Less Than a Week Left'],
            $days <= 15 => ['#2563EB', "Heads Up – {$days} Days Left"],
            default     => ['#6B7280', 'Notice'],
        };
    }
}
