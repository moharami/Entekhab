<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Service</title>
</head>
<body>
<h1>Welcome, {{ $user->name }}!</h1>
<p>Thank you for registering with our service. We're excited to have you on board!</p>
<p>Your registered mobile number is: {{ $user->mobile }}</p>
<p>If you have any questions, please don't hesitate to contact us.</p>
</body>
</html>