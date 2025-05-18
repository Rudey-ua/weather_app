<!-- resources/views/mail/confirm-weather-subscription-mail.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Your Subscription</title>
</head>
<body style="background-color: #f4f4f4; margin: 0; padding: 0; font-family: Arial, sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" style="padding: 40px 0;">
            <table width="600" cellpadding="0" cellspacing="0"
                   style="background-color: #ffffff; padding: 30px; border-radius: 8px;
                          box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                <tr>
                    <td>
                        <h2 style="color: #333333;">☀️ Confirm Your Subscription</h2>
                        <p style="font-size: 16px; color: #555555;">
                            Thank you for subscribing to daily weather updates!
                            Please confirm your subscription by clicking the button below.
                        </p>
                        <div style="text-align: center; margin: 30px 0;">
                            <a href="{{ url("/api/confirm/{$token}") }}"
                               style="display: inline-block; padding: 12px 24px; background-color: #007bff;
                                      color: #ffffff; text-decoration: none; border-radius: 5px; font-size: 16px;">
                                Confirm Subscription
                            </a>
                        </div>
                        <p style="font-size: 14px; color: #888888;">
                            If you didn't request this, simply ignore the message — no action will be taken.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
