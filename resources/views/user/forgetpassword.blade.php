<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - LastBite</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <style>
        :root {
            --brand-green: #3A6B50;
            --brand-orange: #F59E0B;
            --input-bg: #F3F4F6;
            --page-bg: #FFFFFF;
            --text-dark: #374151;
            --text-light: #6B7280;
            --font-serif: 'Instrument Serif', serif;
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
        .forgot-password-wrapper h1 {
            font-family: var(--font-serif);
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
            margin-bottom: 1rem; /* Added margin for spacing */
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
            background-color: var(--brand-green);
            color: white;
            font-weight: 600;
            padding: 0.75rem 0;
            border-radius: 0.375rem;
            font-size: 1rem;
            border: none;
            margin-top: 0.5rem;
        }
        .btn-reset-custom:hover {
            background-color: #2c503c;
            color: white;
        }
        .back-to-signin-link {
            display: inline-block;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: var(--text-light);
            text-decoration: none;
        }
        .back-to-signin-link a {
            color: var(--brand-orange);
            font-weight: 600;
            text-decoration: none;
        }
        .back-to-signin-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="forgot-password-container">
        <div class="forgot-password-wrapper">
            <h1>Forgot Password</h1>
            <p class="sub-heading">
                Enter your email address and we will send you a link to reset your password.
            </p>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required value="{{ old('email') }}">
                </div>
                <button type="submit" class="btn btn-reset-custom w-100">Send Reset Link</button>
            </form>

            <div class="back-to-signin-link">
                <a href="{{ route('login') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    Back to Sign In
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>