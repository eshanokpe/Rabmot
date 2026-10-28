<?php

return [

    /*
    | How many days before a document's expiry date the "Send WhatsApp
    | Reminder" button starts showing on the admin vehicle renewal record.
    */
    'alert_window_days' => (int) env('WHATSAPP_REMINDER_WINDOW_DAYS', 30),

    /*
    | Link included in the reminder message so the client can start their
    | renewal. Falls back to the application URL.
    */
    'renewal_link' => env('WHATSAPP_REMINDER_LINK', env('APP_URL')),

];
