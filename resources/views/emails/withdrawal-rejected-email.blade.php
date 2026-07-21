@component('mail::message')

<p style="font-weight: bold;">Dear {{ $fullname }},</p>
<br/>
<p>We have reviewed your withdrawal request for <b>₦{{ number_format($amount, 2) }}</b> and are unable to approve it at this time.</p>
<p><b>Reason:</b> {{ $rejectionReason }}</p>
<p>If you believe this was a mistake, please contact us at support@rabmotlicensing.com.</p>

Best regards,
Management<br>
Rabmot Licensing Agency

@endcomponent
