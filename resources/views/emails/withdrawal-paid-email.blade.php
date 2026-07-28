@component('mail::message')

<p style="font-weight: bold;">Dear {{ $fullname }},</p>
<br/>
<p>Your withdrawal request for <b>₦{{ number_format($amount, 2) }}</b> has been paid.</p>
<p><b>Transaction Reference:</b> {{ $transactionReference }}</p>
<p>Thank you for being a Rabmot Licensing Agency agent.</p>

Best regards,
Management<br>
Rabmot Licensing Agency

@endcomponent
