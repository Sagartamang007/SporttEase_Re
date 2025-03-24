<!-- resources/views/errors/404.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            color: #333;
            text-align: center;
            padding: 50px;
        }

        h1 {
            font-size: 100px;
            font-weight: 600;
            color: #e74c3c;
        }

        h2 {
            font-size: 24px;
            color: #555;
        }

        .error-message {
            margin: 30px 0;
        }

        .btn-home {
            padding: 12px 30px;
            background-color: #3498db;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-home:hover {
            background-color: #2980b9;
        }

        .footer {
            font-size: 14px;
            color: #777;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <h1>404</h1>
    <h2>Oops! The page you're looking for doesn't exist.</h2>

    <div class="error-message">
        <p>It seems you've hit a broken link or a page that has been moved or deleted.</p>
    </div>

    <a href="{{ url('/') }}" class="btn-home">Go Back to Home</a>

    <div class="footer">
        <p>&copy; {{ date('Y') }} SportEase. All Rights Reserved.</p>
    </div>

</body>
</html>
