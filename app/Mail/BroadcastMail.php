<?php

namespace App\Mail;

use App\Models\Broadcast;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BroadcastMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $broadcast;

    public function __construct(Broadcast $broadcast)
    {
        $this->broadcast = $broadcast;
    }

    public function build()
    {
        return $this->from(...Setting::mailFrom())
            ->subject($this->broadcast->title)
            ->markdown('emails.broadcast')->with([
                'title' => $this->broadcast->title,
                'body' => $this->broadcast->body,
            ]);
    }
}
