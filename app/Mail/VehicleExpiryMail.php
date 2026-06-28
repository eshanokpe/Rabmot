<?php

namespace App\Mail;

use App\Models\AddVehicleRenewal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VehicleExpiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public User              $user;
    public AddVehicleRenewal $vehicle;
    public string            $documentLabel;
    public int               $daysRemaining;
    public Carbon            $expiryDate;
    public string            $urgencyColor;
    public string            $urgencyText;

    public function __construct(
        User              $user,
        AddVehicleRenewal $vehicle,
        string            $documentLabel,
        int               $daysRemaining,
        Carbon            $expiryDate
    ) {
        $this->user          = $user;
        $this->vehicle       = $vehicle;
        $this->documentLabel = $documentLabel;
        $this->daysRemaining = $daysRemaining;
        $this->expiryDate    = $expiryDate;

        [$this->urgencyColor, $this->urgencyText] = $this->resolveUrgency($daysRemaining);
    }

    public function envelope(): Envelope
    {
        $subject = match ($this->daysRemaining) {
            1  => "⚠️ URGENT: Your {$this->documentLabel} expires TOMORROW!",
            7  => "⏰ Reminder: {$this->documentLabel} expires in 7 days",
            15 => "📋 Notice: {$this->documentLabel} expires in 15 days",
            default => "Notice: {$this->documentLabel} expiring soon",
        };

        return new Envelope(
            from: new Address(config('mail.from.address'), config('mail.from.name')),
            subject: $subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.vehicle.expiry',
        );
    }

    public function attachments(): array
    {
        return [];
    }

    protected function resolveUrgency(int $days): array
    {
        return match ($days) {
            1  => ['#DC2626', 'URGENT – Action Required Today'],
            7  => ['#D97706', 'Reminder – 1 Week Left'],
            15 => ['#2563EB', 'Heads Up – 15 Days Left'],
            default => ['#6B7280', 'Notice'],
        };
    }
}
