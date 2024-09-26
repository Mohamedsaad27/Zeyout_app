<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Zeyout App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .welcome-message {
            font-size: 18px;
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            background-color: #e9e9e9;
        }
        .logo {
            max-width: 200px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            {{-- <img src="{{ asset('images/logo.png') }}" alt="Zeyout App Logo" class="logo"> --}}
            <h1>Welcome to Zeyout App</h1>
        </div>
        <div class="content">
            <p>Dear {{ $user->user_name }},</p>
            <p>Thank you for joining Zeyout App! We're excited to have you on board.</p>
            <div class="welcome-message">
                Welcome to our community!
            </div>
            <p>We hope you'll enjoy using our app and all the features it has to offer. If you have any questions or need assistance, please don't hesitate to reach out to our support team.</p>
            <p>Happy exploring!</p>
            <p>Best regards,<br>The Zeyout App Team</p>
        </div>
    </div>
</body>
</html>
