<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .content {
            padding: 20px;
            color: #333333;
            font-size: 16px;
        }

        .callout {
            margin-top: 30px;
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }

        .callout p {
            margin: 10px 0;
            font-size: 18px;
            color: #333333;
        }

        .callout a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777777;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 style="margin: 0; font-size: 24px;">Notification: Expired ID</h2>
        </div>
        <div class="content">
            <p>Hello {{ $employee->nama }},</p>
            <p>Your employee ID will expire soon. Please update it as soon as possible.</p>
            <div class="callout">
                <p>If your employee ID expires in 2 months, please contact the administrator to extend its duration.</p>
                <p>WhatsApp: <a href="https://wa.me/0822291821312">0822291821312</a></p>
            </div>
            <p>Thank you.</p>
        </div>
        <div class="footer">
            <p>Best regards,</p>
            <p>Your Company Team</p>
        </div>
    </div>
</body>

</html>

