<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Car Rental System</title>
    <link rel="stylesheet" href="/css/styles.css">
    <style>
        .error-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            text-align: center;
            padding: 2rem;
        }
        .error-code {
            font-size: 8rem;
            font-weight: bold;
            color: #f39c12;
            margin: 0;
        }
        .error-message {
            font-size: 1.5rem;
            color: #666;
            margin: 1rem 0;
        }
        .error-description {
            color: #888;
            margin: 1rem 0 2rem;
        }
        .btn-home {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.3s ease;
        }
        .btn-home:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="error-code">404</h1>
        <h2 class="error-message">Page Not Found</h2>
        <p class="error-description">
            The page you're looking for doesn't exist or has been moved.
        </p>
        <a href="/" class="btn-home">Back to Home</a>
    </div>
</body>
</html>
