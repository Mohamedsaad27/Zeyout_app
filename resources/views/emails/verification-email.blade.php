<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
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
        .verification-code {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Email Verification</h1>
        </div>
        <div class="content">
            <p>Dear {{ $user->user_name_en }},</p>
            <p>Thank you for registering with our service. To complete your registration, please use the following verification code:</p>
            <div class="verification-code">
                {{ $user->verification_code }}
            </div>
            <p>This code will expire in {{ $user->verification_code_expiration }} minutes. Please enter this code on our website to verify your email address.</p>
            <p>If you didn't request this verification, please ignore this email.</p>
            <p>Best regards,<br>{{env('APP_NAME')}}</p>
        </div>
    </div>
</body>
</html>
