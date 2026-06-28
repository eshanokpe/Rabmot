@component('mail::message')

<p style="font-weight: bold;"> Dear {{ $fullname }},</p>
<br/>
<p>Congratulations and welcome to the Rabmot Licensing Agency Sub Agent Team! 
We are thrilled to have you on board as part of our team.</p>
<p>Your account has been successfully created, and here are your login details:</p>

<p>
    Username : {{ $username }}<br/>
    Email : {{ $email }}<br/>
    Default password : {{ $password }}
</p>
<br/>
<p>Please use the provided credentials to <b><a href="https://rabmotlicensing.com/agent/login">LOGIN</a></b> your account. We recommend changing your password upon your first login for security purposes.</p>
<p>As a Sub Agent, you play a vital role in our organization's success, and we are confident that you will excel in your new position. You now have the opportunity to earn commissions by referring clients to Rabmot Licensing Agency's services.</p>
<p>If you have any questions or need assistance, please feel free to reach out to us at support@rabmotlicensing.com.</p>
<p>Once again, welcome to the team! We look forward to working with you and wish you every success in your role as a Sub Agent.</p>

Best regards,
Management<br>
Rabmot Licensing Agency 


@endcomponent 