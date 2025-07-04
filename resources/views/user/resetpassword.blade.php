<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - LastBite</title>
    {{-- <link href="{{ asset('bootstrap-5.3.6-dist/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

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
            <h1>Reset Password</h1>
            <p class="sub-heading">
                Please kindly set your new password.
            </p>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="New Password" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="btn btn-reset-custom w-100">Reset Password</button>
            </form>

            
        </div>
    </div>

    <script src="{{ asset('bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>