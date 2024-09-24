
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password Code</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h1 style="color: #1a73e8;">Reset Your Password</h1>
        <p>Hello,</p>
        <p>We received a request to reset your password. If you didn't make this request, you can ignore this email.</p>
        <p>To reset your password, use the following code:</p>
        <div style="background-color: #f2f2f2; padding: 10px; text-align: center; font-size: 24px; font-weight: bold; margin: 20px 0;">
            {{ $code }}
        </div>
        <p>This code will expire in 30 minutes for security reasons. If you need a new code, you can request another one on our website.</p>
        <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
        <p>Best regards,<br>Your App Team</p>
    </div>
</body>
</html>
