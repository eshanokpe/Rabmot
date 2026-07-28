@component('mail::message')

<p style="font-weight: bold;">Dear {{ $fullname }},</p>
<br/>
<p>Congratulations! Your agent application (username: <b>{{ $username }}</b>) has been reviewed and approved.</p>
<p>You can now log in and start using your agent account.</p>

@component('mail::button', ['url' => $loginUrl])
Log In to Your Account
@endcomponent

<p>If you have any questions, please reach out to us at support@rabmotlicensing.com.</p>

Best regards,
Management<br>
Rabmot Licensing Agency

@endcomponent
