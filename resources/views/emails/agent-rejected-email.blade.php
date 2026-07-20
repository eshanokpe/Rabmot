@component('mail::message')

<p style="font-weight: bold;">Dear {{ $fullname }},</p>
<br/>
<p>Thank you for your interest in becoming an agent with Rabmot Licensing Agency.</p>
<p>After reviewing your application (username: <b>{{ $username }}</b>), we are unable to approve it at this time.</p>
<p><b>Reason:</b> {{ $rejectionReason }}</p>
<p>If you believe this was a mistake or would like to reapply with updated information, please contact us at support@rabmotlicensing.com.</p>

Best regards,
Management<br>
Rabmot Licensing Agency

@endcomponent
