@component('mail::message')
Dear **{{ $fullname }}**,

Thanks for creating an account with Rabmot. Enter the verification code below to confirm your email address:

<div style="font-size: 30px; font-weight: 700; letter-spacing: 8px; text-align: center; padding: 18px 0;">
    {{ $code }}
</div>

This code expires in 10 minutes. If you did not create this account, you can ignore this email.

Best regards,<br>
Rabmot Licensing Agency
@endcomponent
