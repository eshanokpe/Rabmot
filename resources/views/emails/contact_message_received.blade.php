<!DOCTYPE html>

<html>

<head>

    <title>New Contact Message</title>

</head>

<body>

    <h2>New Contact Message Received</h2>

    <p>Full Name: {{ $contactMessage->fullname }}</p>

    <p>Email: {{ $contactMessage->email }}</p>

    <p>Phone Number: {{ $contactMessage->phone }}</p>

    <p>Subject: {{ $contactMessage->subject }}</p>

    <p>Message: {{ $contactMessage->message }}</p>

</body>

</html>

