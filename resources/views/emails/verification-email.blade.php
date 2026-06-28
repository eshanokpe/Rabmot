@component('mail::message')

Dear **{{ $fullname }}**,

Thanks for creating a profile with us.

Please click the button to verify your email address and login

@component('mail::button', ['url' => url('/verifyemail/'.$email_token) ])
Verify Email Address
@endcomponent

We're excited to have you join us and we are committed to providing you with topnotch service every step of the way.

Best regards,<br>
Management<br>
Rabmot Licensing Agency




@endcomponent 