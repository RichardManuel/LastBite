<!-- resources/views/auth/signup_eatery.blade.php (atau nama file yang Anda inginkan) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Eatery - Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-yellow-navbar: #F5C563; /* Warna kuning navbar dari gambar */
            --brand-orange-accent: #F9A826; /* Warna oranye untuk "Sign Up" dan tombol */
            --brand-text-dark: #3A2E39; /* Warna teks gelap seperti "My Eatery" */
            --brand-text-muted: #6c757d; /* Warna teks abu-abu */
            --input-bg: #F0F0F0; /* Warna background input dari gambar */
            --font-serif-display: 'Playfair Display', serif; /* Font untuk "My Eatery" dan "Sign Up" */
            --font-sans-body: 'Roboto', sans-serif; /* Font untuk teks lainnya */
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Instrument Serif', serif;
            background-color: #FFFFFF; /* Latar belakang putih seperti gambar */
            display: flex;
            flex-direction: column;
        }

        /* Navbar Styles */
        .navbar-custom {
            background-color: var(--brand-yellow-navbar);
            padding-top: 0.8rem;
            padding-bottom: 0.8rem;
        }
        .navbar-custom .navbar-brand img {
            height: 28px; /* Sesuaikan tinggi logo */
        }
        .navbar-custom .nav-link {
            color: var(--brand-text-dark) !important;
            font-weight: 500;
            font-size: 0.9rem;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .navbar-custom .nav-link:hover {
            opacity: 0.8;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            align-items: center; /* Vertically center */
            justify-content: center; /* Horizontally center */
            padding: 2rem 1rem; /* Padding atas bawah dan samping */
        }

        .signup-container {
            width: 100%;
            max-width: 420px; /* Lebar kontainer form */
            text-align: center;
        }

        .signup-container .eatery-title {
            font-family: var(--font-serif-display);
            color: var(--brand-text-dark);
            font-size: 3rem; /* Ukuran font lebih besar */
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .signup-container .signup-title {
            font-family: var(--font-serif-display);
            color: var(--brand-orange-accent);
            font-size: 2.25rem; /* Ukuran font lebih besar */
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
            border: none; /* Hilangkan border default */
            border-radius: 0.375rem; /* rounded-md */
            padding: 0.9rem 1rem;
            font-size: 0.95rem;
            color: #495057;
        }
        .form-control-custom::placeholder {
            color: #6c757d; /* Warna placeholder lebih gelap sedikit */
        }
        .form-control-custom:focus {
            background-color: var(--input-bg);
            border-color: var(--brand-orange-accent);
            box-shadow: 0 0 0 0.2rem rgba(249, 168, 38, 0.25);
        }

        .form-check-custom {
            display: flex;
            align-items: center;
            justify-content: flex-start; /* Rata kiri */
            font-size: 0.875rem;
            color: var(--brand-text-muted);
        }
        .form-check-custom .form-check-input {
            border-radius: 0.25rem;
            border: 1px solid #ced4da; /* Border tipis untuk checkbox */
            margin-top: 0.1em; /* Penyesuaian posisi vertikal checkbox */
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
        .form-check-custom .form-check-label a:hover {
            text-decoration: underline;
        }

        .btn-submit-custom {
            background-color: var(--brand-orange-accent);
            color: white;
            font-weight: 500;
            padding: 0.75rem 0;
            border-radius: 0.375rem;
            font-size: 1rem;
            border: none;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-submit-custom:hover {
            background-color: #e0931f; /* Warna oranye lebih gelap sedikit */
            color: white;
        }

        .divider-custom {
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--brand-text-muted);
            font-size: 0.875rem;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .divider-custom::before,
        .divider-custom::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dee2e6; /* Warna garis */
        }
        .divider-custom:not(:empty)::before {
            margin-right: .5em;
        }
        .divider-custom:not(:empty)::after {
            margin-left: .5em;
        }

        .btn-social-custom {
            border: 1px solid #dee2e6; /* Border untuk tombol sosial */
            border-radius: 0.375rem;
            padding: 0.6rem 0;
            font-size: 0.95rem;
            color: var(--brand-text-dark);
            background-color: #FFFFFF;
            transition: background-color 0.2s ease-in-out;
        }
        .btn-social-custom:hover {
            background-color: #f8f9fa;
        }
        .btn-social-custom img {
            height: 20px;
            margin-right: 0.5rem;
        }

        .alert-custom ul {
            margin-bottom: 0;
            padding-left: 1.25rem;
        }

    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('img/logo lastbite putih 1.png') }}" alt="LastBite Logo"> <!-- Ganti dengan path logo Anda -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavMain" aria-controls="navbarNavMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavMain">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Stocks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content for Signup Form -->
    <main class="main-content">
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

            <form method="POST" action="{{ route('resto.signup.submit') }}"> <!-- Pastikan action ke route yang benar -->
                @csrf

                <div class="mb-3">
                    <input id="email" type="email" class="form-control form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                    @error('email')
                        <span class="invalid-feedback d-block text-start" role="alert"><small><strong>{{ $message }}</strong></small></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="password" type="password" class="form-control form-control-custom @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback d-block text-start" role="alert"><small><strong>{{ $message }}</strong></small></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="password-confirm" type="password" class="form-control form-control-custom" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                    <!-- Pesan error untuk password_confirmation biasanya ditangani oleh validasi 'confirmed' di backend -->
                </div>

                <div class="form-check form-check-custom mb-4">
                    <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" {{ old('terms') ? 'checked' : '' }} required>
                    <label class="form-check-label ms-2" for="terms">
                        I agree to the <a href="#">Term & Conditions</a>
                    </label>
                    @error('terms')
                        <span class="invalid-feedback d-block text-start mt-1" role="alert"><small><strong>{{ $message }}</strong></small></span>
                    @enderror
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-submit-custom w-100">Let's start!</button>
                </div>
            </form>

            <div class="divider-custom">Or register with</div>

            <div class="row g-2">
                <div class="col">
                    <a href="#" class="btn btn-social-custom w-100 d-flex align-items-center justify-content-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google logo"> Google
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="btn btn-social-custom w-100 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('img/facebook_logo_icon.png') }}" alt="Facebook logo"> Facebook <!-- Pastikan Anda punya ikon FB -->
                    </a>
                </div>
            </div>

            <!-- Jika perlu, tambahkan link ke halaman Login -->
            <!--
            <p class="mt-4 text-center text-muted">
                Already have an account? <a href="{{-- route('login') --}}" style="color: var(--brand-orange-accent); text-decoration: none; font-weight: 500;">Sign In</a>
            </p>
            -->

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>