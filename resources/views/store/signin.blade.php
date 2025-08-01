<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - LastBite Eatery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Instrument+Serif:ital@0;1&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --brand-green: #3A6B50;
            --brand-orange-text: #F59E0B;
            --input-bg: #F3F4F6;
            --form-column-bg: #FFFFFF;
            --text-dark: #374151;
            --text-light: #6B7280;
            --font-serif: 'Instrument Sans', sans-serif;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Instrument Sans', sans-serif;
            display: flex;
        }

        .register-full-page-layout {
            display: flex;
            width: 100%;
            height: 100vh;
            /* Fullscreen */
        }

        .register-image-column {
            flex: 0 0 50%;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .register-image-column img.illustration {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .register-form-column {
            flex: 1 1 auto;
            background-color: var(--form-column-bg);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3rem 2rem;
        }

        .register-form-wrapper {
            width: 100%;
            max-width: 430px;
            text-align: center;
        }

        .register-form-wrapper .eatery-title {
            font-family: var(--font-serif);
            color: var(--text-dark);
            font-size: 4.2rem;
            font-weight: 500;
            font-family: 'Instrument Serif', serif;
            margin-bottom: 3rem;
        }

        .register-form-wrapper h1 {
            font-family: var(--font-serif);
            color: var(--brand-orange-text);
            font-size: 3rem;
            font-weight: 500;
            font-family: 'Instrument Serif', serif;
            margin-bottom: 0.75rem;
        }

        .register-form-wrapper .sub-heading {
            font-size: 0.875rem;
            color: var(--text-light);
            margin-bottom: 1.8rem;
            line-height: 1.5;
        }

        .register-form-wrapper .sub-heading a {
            color: var(--brand-green);
            font-weight: 600;
            text-decoration: none;
        }

        .register-form-wrapper .sub-heading a:hover {
            text-decoration: underline;
        }

        .form-control {
            background-color: var(--input-bg);
            border: 1px solid #E5E7EB;
            border-radius: 0.5rem;
            padding: 0.85rem 1rem;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            background-color: var(--input-bg);
            border-color: var(--brand-orange-text);
            box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25);
        }

        .forgot-password-link {
            font-size: 0.8rem;
            color: var(--text-light);
            text-decoration: none;
            display: block;
            text-align: right;
            margin-bottom: 1.5rem;
        }

        .forgot-password-link:hover {
            text-decoration: underline;
            color: var(--text-dark);
        }

        .btn-submit-custom {
            background-color: #F3C148;
            color: white;
            font-weight: 600;
            padding: 0.75rem 0;
            border-radius: 0.5rem;
            font-size: 1rem;
            border: none;
        }

        .btn-submit-custom:hover {
            background-color: #d98c00;
        }

        .account-prompt {
            font-size: 0.875rem;
            color: var(--text-light);
            text-align: center;
            margin-top: 1rem;
        }

        .account-prompt a {
            color: var(--brand-green);
            font-weight: 600;
            text-decoration: none;
        }

        .account-prompt a:hover {
            text-decoration: underline;
        }

        /* Responsif */
        @media (max-width: 991.98px) {
            .register-image-column {
                display: none;
                /* Hide image on tablet/mobile */
            }

            .register-form-column {
                padding: 2rem 1.5rem;
            }
        }

        @media (max-width: 575.98px) {
            .register-form-wrapper .eatery-title {
                font-size: 2rem;
            }

            .register-form-wrapper h1 {
                font-size: 1.75rem;
            }

            .form-control {
                padding: 0.6rem 0.9rem;
                font-size: 0.85rem;
            }

            .btn-submit-custom {
                padding: 0.6rem 0;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>

    <div class="register-full-page-layout">
        <!-- Kolom Gambar -->
        <div class="register-image-column">
            <img src="{{ asset('img/signin store.png') }}" alt="Sign In Illustration" class="illustration">
        </div>

        <!-- Kolom Form -->
        <div class="register-form-column">
            <div class="register-form-wrapper">
                <h2 class="eatery-title">My Eatery</h2>
                <h1>Sign in</h1>
                <p class="sub-heading">
                    Let’s Get in Touch! 🤝 <br>
                    Whether you need a daily surprise bag or a bulk order for your restaurant, <br>
                    we’re ready to support your culinary journey.
                </p>

                <form action="{{ url('/store/signin') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                            required value="{{ old('email') }}">
                    </div>
                    <div class="mb-2">
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Password" required>
                    </div>
                    <a href="#" class="forgot-password-link">Forgot password?</a>

                    <button type="submit" class="btn btn-submit-custom w-100">Let's start!</button>
                </form>

                <p class="account-prompt">
                    Don't have an account? <a href="{{ route('resto.signup.form') }}">Sign up</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
