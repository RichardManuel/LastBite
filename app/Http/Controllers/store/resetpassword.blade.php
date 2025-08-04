<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - LastBite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <style>
        :root {
            --brand-green: #3A6B50;
            --brand-orange: #F59E0B;
            --input-bg: #F3F4F6;
            --page-bg: #FFFFFF;
            --text-dark: #374151;
            --text-light: #6B7280;
            --font-serif: 'Georgia', 'Times New Roman', serif;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: var(--font-serif);
            background-color: var(--page-bg);
            overflow-x: hidden;
        }

        .forgot-password-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            padding: 2rem 1rem;
            text-align: center;
        }

        .forgot-password-wrapper {
            width: 100%;
            max-width: 400px;
        }

        .forgot-password-icon-container {
            margin-bottom: 1.5rem;
        }

        .forgot-password-icon-container img {
            width: 80px;
            height: 80px;
        }

        .forgot-password-wrapper h1 {
            color: var(--brand-green);
            font-size: 2rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .forgot-password-wrapper .sub-heading {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 2rem;
        }

        .form-control {
            background-color: var(--input-bg);
            border: 1px solid #E5E7EB;
            border-radius: 0.375rem;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            text-align: left;
        }

        .form-control:focus {
            background-color: var(--input-bg);
            border-color: var(--brand-green);
            box-shadow: 0 0 0 0.2rem rgba(58, 107, 80, 0.25);
        }

        .form-control::placeholder {
            color: #9CA3AF;
        }

        .btn-reset-custom {
            background-color: var(--brand-orange);
            color: white;
            font-weight: 600;
            padding: 0.75rem 0;
            border-radius: 0.375rem;
            font-size: 1rem;
            margin-top: 0.5rem;
        }

        .btn-reset-custom:hover {
            background-color: #d97706;
            color: white;
        }
    </style>
</head>
<body>

    <div class="forgot-password-container">
        <div class="forgot-password-wrapper">

        

            <h1>Reset Password</h1>
            <p class="sub-heading">
                Please kindly set your new password.
            </p>

            <!-- Form Reset Password (UI saja) -->
            <form action="#" method="POST">
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="New Password" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="btn btn-reset-custom w-100">Reset Password</button>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
