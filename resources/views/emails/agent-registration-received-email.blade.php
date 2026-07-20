@component('mail::message')

<p style="font-weight: bold;">Dear {{ $fullname }},</p>
<br/>
<p>Thank you for applying to become an agent with Rabmot Licensing Agency.</p>
<p>We have received your application (username: <b>{{ $username }}</b>) along with your submitted documents. Our team will review your details shortly, and you will receive another email once a decision has been made.</p>
<p>If you have any questions in the meantime, please reach out to us at support@rabmotlicensing.com.</p>

Best regards,
Management<br>
Rabmot Licensing Agency

@endcomponent
