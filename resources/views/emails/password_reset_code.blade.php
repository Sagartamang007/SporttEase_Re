

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Code</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f9f7;
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
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            text-align: center;
            border-top: 5px solid #28a745;
        }
        .icon-container {
            margin-bottom: 25px;
        }
        .icon-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #28a745, #218838);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }
        .header {
            font-size: 26px;
            font-weight: 700;
            color: #1e3a29;
            margin-bottom: 25px;
            padding-bottom: 15px;
            position: relative;
        }
        .header:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #28a745, #5cb85c);
            border-radius: 3px;
        }
        .message {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 30px;
            padding: 0 15px;
        }
        .code-container {
            background: linear-gradient(120deg, #e0f7fa, #e0ffe0);
            border-radius: 12px;
            padding: 25px 20px;
            margin: 30px 0;
            border: 1px solid rgba(40, 167, 69, 0.2);
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.1);
        }
        .code {
            font-size: 38px;
            font-weight: bold;
            color: #28a745;
            letter-spacing: 6px;
            font-family: 'Courier New', monospace;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        .expiry {
            font-size: 16px;
            color: #666;
            margin: 20px 0;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 8px;
            display: inline-block;
        }
        .expiry strong {
            color: #dc3545;
            font-weight: 600;
        }
        @media only screen and (max-width: 600px) {
            .container {
                padding: 30px 15px;
            }
            .code {
                font-size: 32px;
                letter-spacing: 4px;
            }
            .icon-circle {
                width: 70px;
                height: 70px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Password Reset Verification</div>
        <div class="message">
            <p>Hello,</p>
            <p>We received a request to reset your password. To continue with the password reset process, please use the verification code below:</p>
        </div>
        <div class="code-container">
            <div class="code" aria-label="Your verification code">{{ $code }}</div>
        </div>
        <div class="expiry">This code will expire in <strong>15 minutes</strong></div>
    </div>
</body>
</html>
