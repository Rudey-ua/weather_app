<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather Update</title>
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
                        <h2 style="color: #333333;">🌤️ {{ ucfirst($type) }} Weather Update</h2>
                        <p style="font-size: 16px; color: #555555;">
                            Here's the latest weather update for {{ $city }}:
                        </p>
                        <ul style="font-size: 16px; color: #333333; padding-left: 20px;">
                            <li><strong>Temperature:</strong> {{ $temperature }}°C</li>
                            <li><strong>Humidity:</strong> {{ $humidity }}%</li>
                            <li><strong>Condition:</strong> {{ $description }}</li>
                        </ul>
                        <hr style="margin: 30px 0; border: none; border-top: 1px solid #e0e0e0;">
                        <p style="font-size: 14px; color: #888888;">
                            If you no longer wish to receive weather updates, you can
                            <a href="{{ url("/api/unsubscribe/{$token}") }}" style="color: #007bff; text-decoration: none;">
                                unsubscribe here
                            </a>.
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
