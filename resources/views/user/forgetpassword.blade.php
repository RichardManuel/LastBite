<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - LastBite</title>
    <link href="{{ asset('bootstrap-5.3.6-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        :root {
            --brand-green: #3A6B50;
            --brand-orange: #F59E0B; /* Warna untuk link "Sign in" */
            --brand-yellow-icon-bg: #FDE68A; /* Perkiraan background ikon kuning */
            --brand-yellow-icon-lock: #D97706; /* Perkiraan warna gembok di ikon */
            --input-bg: #F3F4F6;
            --page-bg: #FFFFFF; /* Background halaman putih seperti di gambar */
            --text-dark: #374151;
            --text-light: #6B7280;
            --font-serif: 'Georgia', 'Times New Roman', serif;
            --font-sans: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Instrument Serif', serif;
            background-color: var(--page-bg);
            overflow-x: hidden;
        }

        .forgot-password-container {
            display: flex;
            flex-direction: column; /* Konten disusun vertikal */
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            padding: 2rem 1rem; /* Padding untuk layar kecil */
            text-align: center; /* Semua teks di dalam container akan center */
        }

        .forgot-password-wrapper {
            width: 100%;
            max-width: 400px; /* Lebar maksimal untuk konten form */
        }

        .forgot-password-icon-container {
            margin-bottom: 1.5rem;
        }

        .forgot-password-icon-container img {
            width: 80px; /* Sesuaikan ukuran ikon Anda */
            height: 80px;
            /* Jika Anda membuat ikon dengan CSS:
            background-color: var(--brand-yellow-icon-bg);
            border-radius: 50%;
            padding: 1.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            */
        }
        /* Contoh SVG untuk ikon gembok jika Anda tidak punya gambar:
        .forgot-password-icon-container svg {
            width: 30px;
            height: 30px;
            fill: var(--brand-yellow-icon-lock);
        }
        */


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
            text-align: left; /* Kembalikan text align kiri untuk input */
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
            margin-top: 0.5rem; /* Jarak dari input email */
        }
        .btn-reset-custom:hover {
            background-color: #2c503c;
            color: white;
        }

        .back-to-signin-link {
            display: inline-block; /* Agar margin top berfungsi */
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
        .back-to-signin-link svg { /* Untuk ikon panah kiri */
            width: 1em;
            height: 1em;
            vertical-align: -0.125em; /* Sesuaikan agar sejajar dengan teks */
            margin-right: 0.25rem;
        }

    </style>
</head>
<body>

    <div class="forgot-password-container">
        <div class="forgot-password-wrapper">
            <div class="forgot-password-icon-container">
                <img src="{{ asset('img/Forget password.png') }}" alt="Forgot Password Icon">
            </div>

            <h1>Forgot your password?</h1>
            <p class="sub-heading">
                No worries, we’ll send you reset instructions.
            </p>

            <form action="{{-- url('/forgot-password') --}}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required value="{{ old('email') }}">
                </div>
                <button type="submit" class="btn btn-reset-custom w-100">Reset Password</button>
            </form>

            <div class="back-to-signin-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
                Back to <a href="{{-- url('/login') --}}#">Sign in.</a>
            </div>
        </div>
    </div>

    <script src="{{ asset('bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>