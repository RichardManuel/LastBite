<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account - LastBite</title>
    <link href="{{ asset('bootstrap-5.3.6-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        :root {
            --brand-green: #3A6B50;
            --brand-green-light-texture: #E0EFEA; /* Perkiraan warna untuk background tekstur kiri, sesuaikan! */
            --brand-orange: #F59E0B;
            --input-bg: #F3F4F6;
            --form-column-bg: #FFFFFF; /* Warna background kolom kanan */
            --text-dark: #374151;
            --text-light: #6B7280;
            --font-serif: 'Georgia', 'Times New Roman', serif;
            --font-sans: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        }

        html, body {
            height: 100vh;
            margin: 0;
            font-family: 'Instrument Serif', serif;
            overflow-x: hidden; /* Mencegah scroll horizontal jika ada sedikit overflow */
        }

        .register-full-page-layout {
            display: flex;
            min-height: 100vh; /* Memastikan layout mengisi tinggi viewport */
            width: 100%;
        }

        .register-image-column {
            /* flex: 0 0 50%;  */
            /* background-color: var(--brand-green-light-texture); -- DIHAPUS -- */
            /* background-image: url('...'); -- DIHAPUS -- */
            display: flex;
            /* justify-content: center; */
            align-items: center;
            position: relative; /* Berguna jika Anda ingin memposisikan sesuatu absolut di dalamnya */
        }

        .register-image-column img.illustration {
            display: flex;
            /* max-width: 80%; Lebih besar agar mengisi kolom kiri dengan baik */
            max-height: 100%; /* Pastikan gambar tidak melebihi tinggi kolom */
            /* object-fit: contain; */
        }

        .register-form-column {
            flex: 1 1 auto; /* Mengambil sisa ruang dan bisa tumbuh/menyusut */
            background-color: var(--form-column-bg);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3rem 2rem; /* Padding di dalam kolom form */
            overflow-y: auto; /* Scroll jika konten form sangat panjang */
        }

        .register-form-wrapper {
            width: 100%;
            max-width: 430px; /* Lebar maksimal untuk konten form */
        }

        .register-form-wrapper h1 {
            font-family: var(--font-serif);
            color: var(--brand-green);
            font-size: 2.2rem; /* Sedikit disesuaikan */
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .register-form-wrapper .sub-heading {
            font-size: 0.875rem; /* Sedikit disesuaikan */
            color: var(--text-light);
            margin-bottom: 1.8rem; /* Sedikit disesuaikan */
        }

        .register-form-wrapper .sub-heading a {
            color: var(--brand-orange);
            font-weight: 600;
            text-decoration: none;
        }
         .register-form-wrapper .sub-heading a:hover {
            text-decoration: underline;
        }

        .form-control {
            background-color: var(--input-bg);
            border: 1px solid #E5E7EB;
            border-radius: 0.375rem; /* Sedikit lebih kecil roundednya */
            padding: 0.7rem 1rem; /* Sedikit disesuaikan */
            font-size: 0.9rem;
        }
        .form-control:focus {
            background-color: var(--input-bg);
            border-color: var(--brand-green);
            box-shadow: 0 0 0 0.2rem rgba(58, 107, 80, 0.25);
        }
        .form-control::placeholder {
            color: #9CA3AF; /* Placeholder sedikit lebih gelap */
        }

        .form-check-input {
            border-radius: 0.2em;
            border: 1px solid #9CA3AF;
        }
        .form-check-input:checked {
            background-color: var(--brand-green);
            border-color: var(--brand-green);
        }
        .form-check-label {
            font-size: 0.85rem; /* Sedikit disesuaikan */
            color: var(--text-light);
            padding-left: 0.25rem;
        }
        .form-check-label a {
            color: var(--brand-orange);
            font-weight: 500;
            text-decoration: none;
        }
        .form-check-label a:hover {
            text-decoration: underline;
        }

        .btn-submit-custom {
            background-color: var(--brand-green);
            color: white;
            font-weight: 600;
            padding: 0.7rem 0; /* Padding vertikal */
            border-radius: 0.375rem;
            font-size: 1rem;
        }
        .btn-submit-custom:hover {
            background-color: #2c503c;
            color: white;
        }

        .social-divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--text-light);
            font-size: 0.75rem; /* Sedikit disesuaikan */
            margin: 1.25rem 0; /* Sedikit disesuaikan */
        }
        .social-divider::before,
        .social-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #E5E7EB;
        }
        .social-divider:not(:empty)::before { margin-right: .5em; }
        .social-divider:not(:empty)::after { margin-left: .5em; }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.55rem; /* Sedikit disesuaikan */
            border: 1px solid #D1D5DB;
            border-radius: 0.375rem;
            background-color: white;
            color: var(--text-dark);
            font-weight: 500;
            font-size: 0.875rem; /* Sedikit disesuaikan */
            text-decoration: none;
        }
        .btn-social:hover {
            background-color: #f9fafb;
            color: var(--text-dark);
        }
        .btn-social img, .btn-social svg {
            width: 18px; /* Sedikit disesuaikan */
            height: 18px; /* Sedikit disesuaikan */
            margin-right: 0.5rem;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 991px) { /* Tablet */
            .register-full-page-layout {
                flex-direction: column;
            }
            .register-image-column {
                flex: 0 0 auto; /* Lebar tidak lagi 50%, biarkan konten menentukan */
                min-height: 35vh; /* Tinggi minimum untuk kolom gambar di tablet */
                /* display: none; */ /* Opsi: sembunyikan jika mau */
            }
            .register-image-column img.illustration {
                 max-height: 30vh; /* Sesuaikan tinggi gambar */
            }
            .register-form-column {
                flex: 1 1 auto; /* Form mengambil sisa tinggi */
                padding: 2rem 1.5rem;
            }
        }
        @media (max-width: 576px) { /* Mobile */
             .register-image-column {
                display: none; /* Sembunyikan gambar di mobile agar fokus ke form */
            }
            .register-form-column {
                padding: 2rem 1rem; /* Padding lebih kecil lagi */
                min-height: 100vh; /* Pastikan form mengisi layar jika gambar hilang */
            }
             .register-form-wrapper h1 {
                font-size: 1.9rem;
            }
        }
    </style>
</head>
<body>

    <div class="register-full-page-layout">
        <div class="register-image-column">
            <img src="{{ asset('img/Rectangle 31.png') }}" alt="Create Account Illustration" class="illustration">
        </div>
        <div class="register-form-column">
            <div class="register-form-wrapper">
                <h1>Create an account</h1>
                <p class="sub-heading">
                    Don't have an account? <a href="{{-- url('/login') --}}#">Sign in</a>
                </p>

                <form action="{{-- url('/register') --}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" required value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required value="{{ old('email') }}">
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ old('city') }}">
                        </div>
                        <div class="col-sm-6">
                            <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone" value="{{ old('phone') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password_confirmation" id="confirm_password" placeholder="Confirm password" required>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="terms" value="agree" id="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a href="#">Term & Conditions</a>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-submit-custom w-100">Let's start!</button>
                </form>

                <div class="social-divider">Or register with</div>

                <div class="row g-2">
                    <div class="col">
                        <a href="{{-- url('/auth/google') --}}#" class="btn btn-social w-100">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google logo">
                            Google
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{-- url('/auth/facebook') --}}#" class="btn btn-social w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#1877F2"><path d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.407.593 24 1.324 24h11.494v-9.294H9.689v-3.621h3.129V8.41c0-3.1 1.893-4.785 4.659-4.785 1.325 0 2.463.099 2.795.142v3.24h-1.918c-1.504 0-1.795.715-1.795 1.763v2.309h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.324V1.324C24 .593 23.407 0 22.676 0z"/></svg>
                            Facebook
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>