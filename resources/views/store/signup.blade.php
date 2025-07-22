<!-- resources/views/auth/signup_eatery.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Eatery - Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-orange-accent: #F9A826;
            --brand-text-dark: #3A2E39;
            --brand-text-muted: #6c757d;
            --input-bg: #F0F0F0;
            --font-serif-display: 'Playfair Display', serif;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Instrument Serif', serif;
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signup-container {
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        .signup-container .eatery-title {
            font-family: var(--font-serif-display);
            color: var(--brand-text-dark);
            font-size: 3rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .signup-container .signup-title {
            font-family: var(--font-serif-display);
            color: var(--brand-orange-accent);
            font-size: 2.25rem;
            font-weight: 500;
            margin-bottom: 0.75rem;
        }

        .signup-container .sub-heading {
            font-size: 0.95rem;
            color: var(--brand-text-muted);
            margin-bottom: 2.5rem;
        }

        .form-control-custom {
            background-color: var(--input-bg);
            border: none;
            border-radius: 0.375rem;
            padding: 0.9rem 1rem;
            font-size: 0.95rem;
            color: #495057;
        }
        .form-control-custom::placeholder {
            color: #6c757d;
        }
        .form-control-custom:focus {
            background-color: var(--input-bg);
            border-color: var(--brand-orange-accent);
            box-shadow: 0 0 0 0.2rem rgba(249, 168, 38, 0.25);
        }

        .form-check-custom {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            font-size: 0.875rem;
            color: var(--brand-text-muted);
        }
        .form-check-custom .form-check-input:checked {
            background-color: var(--brand-orange-accent);
            border-color: var(--brand-orange-accent);
        }
        .form-check-custom .form-check-label a {
            color: var(--brand-orange-accent);
            text-decoration: none;
            font-weight: 500;
        }

        .btn-submit-custom {
            background-color: #F3C148;
            color: white;
            font-weight: 500;
            padding: 0.75rem 0;
            border-radius: 0.375rem;
            font-size: 1rem;
            border: none;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-submit-custom:hover {
            background-color: #e0931f;
        }

        .alert-custom ul {
            margin-bottom: 0;
            padding-left: 1.25rem;
        }
    </style>
</head>
<body>

    <!-- Main Content Only -->
    <div class="signup-container">
        <h2 class="eatery-title">My Eatery</h2>
        <h1 class="signup-title">Sign Up</h1>
        <p class="sub-heading">
            Help Reduce Food Waste—Sell Your Unsold Goods with Us
        </p>

        @if ($errors->any())
            <div class="alert alert-danger alert-custom mb-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('resto.signup.submit') }}">
            @csrf

            <div class="mb-3">
                <input id="email" type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email">
                @error('email')
                    <span class="invalid-feedback d-block text-start"><small><strong>{{ $message }}</strong></small></span>
                @enderror
            </div>

            <div class="mb-3">
                <input id="password" type="password" class="form-control form-control-custom @error('password') is-invalid @enderror" name="password" required placeholder="Password">
                @error('password')
                    <span class="invalid-feedback d-block text-start"><small><strong>{{ $message }}</strong></small></span>
                @enderror
            </div>

            <div class="mb-3">
                <input id="password-confirm" type="password" class="form-control form-control-custom" name="password_confirmation" required placeholder="Confirm password">
            </div>

            <div class="form-check form-check-custom mb-4">
                <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" {{ old('terms') ? 'checked' : '' }} required>
                <label class="form-check-label ms-2" for="terms">
                    I agree to the <a href="#">Term & Conditions</a>
                </label>
                @error('terms')
                    <span class="invalid-feedback d-block text-start mt-1"><small><strong>{{ $message }}</strong></small></span>
                @enderror
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-submit-custom w-100">Let's start!</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
