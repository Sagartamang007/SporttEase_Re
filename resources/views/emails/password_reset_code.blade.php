<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Code</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
        }
        .logo {
            margin-bottom: 25px;
        }
        .header {
            font-size: 24px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 25px;
            border-bottom: 1px solid #eaeaea;
            padding-bottom: 15px;
        }
        .message {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 30px;
        }
        .code-container {
            background-color: #f7fafc;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
            border: 1px dashed #e2e8f0;
        }
        .code {
            font-size: 32px;
            font-weight: bold;
            color: #3182ce;
            letter-spacing: 2px;
            font-family: monospace;
        }
        .expiry {
            font-size: 15px;
            color: #718096;
            margin: 15px 0 25px;
        }
        .expiry strong {
            color: #e53e3e;
        }
        .btn {
            display: inline-block;
            padding: 12px 28px;
            font-size: 16px;
            font-weight: 600;
            color: #ffffff;
            background: #4299e1;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #3182ce;
        }
        .footer {
            font-size: 14px;
            color: #718096;
            margin-top: 35px;
            padding-top: 20px;
            border-top: 1px solid #eaeaea;
        }
        .help-text {
            font-size: 13px;
            color: #a0aec0;
            margin-top: 15px;
        }
        @media only screen and (max-width: 600px) {
            .container {
                padding: 25px 15px;
            }
            .code {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <!-- You can add your logo here -->
            <!-- <img src="your-logo.png" alt="Company Logo" width="120"> -->
        </div>
        <div class="header">Password Reset Request</div>
        <div class="message">
            <p>Hello,</p>
            <p>We received a request to reset your password. To continue with the password reset process, please use the verification code below:</p>
        </div>
        <div class="code-container">
            <div class="code" aria-label="Your verification code">{{ $code }}</div>
        </div>
        <div class="expiry">This code will expire in <strong>15 minutes</strong></div>
        <a href="{{ route('password.resetForm') }}" class="btn">Reset Password</a>
        <div class="footer">
            If you did not request this password reset, please ignore this email or contact support if you have concerns.
        </div>
        <div class="help-text">
            Need help? Reply to this email or contact our support team.
        </div>
    </div>
</body>
</html>
