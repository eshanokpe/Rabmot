<?php

// Document expiry reminders (WhatsApp, email and SMS). The file name predates
// the email/SMS channels.
return [

    /*
    | How many days before a document's expiry date it counts as "expiring
    | soon": the reminder buttons and the dashboard tile use this window.
    */
    'alert_window_days' => (int) env('WHATSAPP_REMINDER_WINDOW_DAYS', 30),

    /*
    | Link included in reminder messages so the client can start their
    | renewal. Falls back to the application URL.
    */
    'renewal_link' => env('WHATSAPP_REMINDER_LINK', env('APP_URL')),

    /*
    | Automatic daily email (notify:vehicle-expiry): one email per document at
    | each of these points, in days before expiry.
    */
    'automatic_points' => array_values(array_filter(array_map(
        'intval',
        explode(',', (string) env('EXPIRY_REMINDER_DAYS', '30,15,7,1'))
    ), fn ($days) => $days > 0)),

    /*
    | Send one final "your document has expired" email, but only for documents
    | that expired within this many days (so long-expired records are not
    | emailed in bulk). Set EXPIRY_REMINDER_EXPIRED_EMAIL=false to turn it off.
    */
    'automatic_expired_email' => filter_var(env('EXPIRY_REMINDER_EXPIRED_EMAIL', true), FILTER_VALIDATE_BOOLEAN),
    'automatic_expired_within_days' => 7,

];
