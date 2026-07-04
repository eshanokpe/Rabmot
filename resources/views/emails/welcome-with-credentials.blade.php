@component('mail::message')

Dear <strong>{{ $fullname }}</strong>,

Thank you for your payment. Your application has been received and is now being processed.

---

**A Rabmot account has been created for you** so you can track your application progress at any time.

**Your Login Credentials:**

| Field | Value |
|---|---|
| **Email** | {{ $email }} |
| **Temporary Password** | {{ $tempPassword }} |

@component('mail::button', ['url' => url('/login')])
Login to Your Account
@endcomponent

> **Important:** Please log in and change your password as soon as possible to keep your account secure.

---

**Your Application Summary:**

| | |
|---|---|
| **Service** | {{ $processType }} |
| **Reference No.** | {{ $processId }} |
| **Amount Paid** | ₦{{ number_format($amount, 2) }} |
| **Status** | Processing |

You will receive further updates on your application via email.

Thank you for choosing Rabmot Licensing Agency.

Sincerely,
Management
Rabmot Licensing Agency

@endcomponent
