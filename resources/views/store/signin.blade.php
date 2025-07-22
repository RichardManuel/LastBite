<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - LastBite Eatery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        :root {
            --brand-green: #3A6B50; /* Warna hijau LastBite yang sudah ada */
            --brand-yellow-navbar: #F59E0B; /* Warna kuning/oranye untuk navbar seperti di gambar "My Eatery" */
            --brand-orange-text: #F59E0B; /* Warna oranye untuk teks "Sign in" */
            --input-bg: #F3F4F6;
            --form-column-bg: #FFFFFF;
            --text-dark: #374151;
            --text-light: #6B7280;
            --font-serif: 'Georgia', 'Times New Roman', serif;
            --font-sans: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        }

        html, body {
            height: 100%; /* Menggunakan height 100% agar .register-full-page-layout bisa mengisi sisa viewport */
            margin: 0;
            font-family: 'Instrument Serif';
            overflow-x: hidden;
            display: flex; /* Menggunakan flexbox pada body */
            flex-direction: column; /* Agar navbar dan konten utama tersusun vertikal */
        }

        /* Navbar My Eatery Styles */
        .navbar-eatery {
            background-color: #F3C148;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* shadow-md */
        }
        .navbar-eatery .navbar-brand img {
            height: 50px; /* Sesuaikan dengan tinggi logo LastBite di navbar Eatery */

        }
        .navbar-eatery .nav-link {
            color: #F9F1E4 !important; /* Teks navbar berwarna gelap */
            font-family: 'Instrument Sans';
            font-weight: 600;
            padding-left: 4rem;
            padding-right: 2rem;
        }
        .navbar-eatery .nav-link:hover,
        .navbar-eatery .nav-link.active {
            color: var(--brand-green) !important; /* Warna hijau untuk hover/active */
        }

        .register-full-page-layout {
            display: flex;
            flex-grow: 1; /* Membuat layout ini mengisi sisa ruang setelah navbar */
            width: 100%;
        }

        .register-image-column {
            flex: 0 0 50%; /* Kolom gambar mengambil 50% lebar */
            background-color: #f0f0f0; /* Warna placeholder jika gambar tidak ada */
            display: flex;
            align-items: center;
            justify-content: center; /* Pusatkan gambar jika lebih kecil */
            overflow: hidden; /* Mencegah gambar keluar batas */
            position: relative;
        }

        .register-image-column img.illustration {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Membuat gambar mengisi kolom tanpa distorsi */
        }

        .register-form-column {
            flex: 1 1 auto;
            background-color: var(--form-column-bg);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3rem 2rem;
            overflow-y: auto;
        }

        .register-form-wrapper {
            width: 100%;
            max-width: 430px;
        }

        .register-form-wrapper .eatery-title {
            font-family: var(--font-serif);
            color: var(--text-dark); /* Warna "My Eatery" */
            font-size: 2.5rem; /* Ukuran font untuk "My Eatery" */
            font-weight: 500;
            margin-bottom: 0.25rem;
            text-align: left; /* Rata kiri */
        }

        .register-form-wrapper h1 { /* Ini untuk "Sign in" */
            font-family: var(--font-serif);
            color: var(--brand-orange-text);
            font-size: 2rem;
            font-weight: 500;
            margin-bottom: 0.75rem;
            text-align: left; /* Rata kiri */
        }

        .register-form-wrapper .sub-heading {
            font-size: 0.875rem;
            color: var(--text-light);
            margin-bottom: 1.8rem;
            text-align: left; /* Rata kiri */
            line-height: 1.5;
        }

        .register-form-wrapper .sub-heading a {
            color: var(--brand-green); /* Warna link Sign up hijau */
            font-weight: 600;
            text-decoration: none;
        }
         .register-form-wrapper .sub-heading a:hover {
            text-decoration: underline;
        }

        .form-control {
            background-color: var(--input-bg);
            border: 1px solid #E5E7EB;
            border-radius: 0.5rem; /* rounded-lg */
            padding: 0.85rem 1rem; /* p-3 atau p-4 */
            font-size: 0.9rem;
            margin-bottom: 1rem; /* mb-4 versi Bootstrap lebih besar, jadi pakai mb-3 */
        }
        .form-control:focus {
            background-color: var(--input-bg);
            border-color: var(--brand-orange-text); /* Border oranye saat fokus */
            box-shadow: 0 0 0 0.2rem rgba(245, 158, 11, 0.25); /* Shadow oranye */
        }
        .form-control::placeholder {
            color: #9CA3AF;
        }

        .forgot-password-link {
            font-size: 0.8rem;
            color: var(--text-light);
            text-decoration: none;
            display: block; /* Agar bisa text-align */
            text-align: right; /* Rata kanan */
            margin-bottom: 1.5rem; /* mb-6 */
        }
        .forgot-password-link:hover {
            text-decoration: underline;
            color: var(--text-dark);
        }


        .btn-submit-custom {
            background-color: #F3C148; /* Tombol "Let's start!" oranye */
            color: white;
            font-weight: 600;
            padding: 0.75rem 0; /* py-3 */
            border-radius: 0.5rem; /* rounded-lg */
            font-size: 1rem;
            border: none;
        }
        .btn-submit-custom:hover {
            background-color: #d98c00; /* Oranye lebih gelap saat hover */
            color: white;
        }

        /* Social login icons */
        .social-icons-container {
            margin-top: 2rem; /* mt-8 */
            margin-bottom: 1.5rem; /* mb-6 */
            display: flex;
            justify-content: center;
            gap: 1.5rem; /* space-x-6 */
        }
        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px; /* Sesuaikan ukuran */
            height: 40px;
            /* border: 1px solid #E5E7EB; /* Optional border */
            /* border-radius: 50%; /* Bulat */
            /* background-color: white; /* Optional background */
        }
        .social-icon img, .social-icon svg {
            width: 24px; /* Ukuran ikon di dalamnya */
            height: 24px;
        }
        .facebook-icon svg { /* Khusus untuk ikon FB agar warnanya sesuai */
            fill: #1877F2;
        }


        .account-prompt {
            font-size: 0.875rem; /* text-sm */
            color: var(--text-light);
            text-align: center; /* Pusatkan teks */
        }

        .account-prompt a {
            color: var(--brand-green); /* Warna link Sign up hijau */
            font-weight: 600; /* font-semibold */
            text-decoration: none;
        }
        .account-prompt a:hover {
            text-decoration: underline;
        }


        /* Responsif untuk layar kecil */
        @media (max-width: 991.98px) { /* Tablet, Bootstrap lg breakpoint */
            .register-image-column {
                display: none; /* Sembunyikan kolom gambar di tablet dan mobile */
            }
            .register-form-column {
                padding: 2rem 1.5rem;
                min-height: calc(100vh - 56px); /* 56px adalah perkiraan tinggi navbar */
            }
        }
        @media (max-width: 575.98px) { /* Mobile, Bootstrap sm breakpoint */
            .register-form-column {
                padding: 2rem 1rem;
            }
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

    <!-- Navbar (Eatery Version) -->
    <nav class="navbar navbar-expand-sm navbar-eatery">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('img/logo lastbite putih 1.png') }}" alt="LastBite Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavEatery" aria-controls="navbarNavEatery" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNavEatery">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item me-4">
                        <a class="nav-link" href="#">Order</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="#">Stocks</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="register-full-page-layout">
        <div class="register-image-column">
            <img src="{{ asset('img/signin store.png') }}" alt="Sign In Illustration" class="illustration">
        </div>
        <div class="register-form-column">
            <div class="register-form-wrapper">
                <h2 class="eatery-title text-center">My Eatery</h2>
                <h1 class="text-center">Sign in</h1>
                <p class="sub-heading text-center">
                    Let’s Get in Touch! 🤝 <br>
                    Whether you need a daily surprise bag or a bulk order for your restaurant, <br>
                    we’re ready to support your culinary journey.
                </p>

                <form action="{{ url('/store/signin') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required value="{{ old('email') }}">
                    </div>
                    <div class="mb-2">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <a href="#" class="forgot-password-link">Forgot password?</a>

                    <button type="submit" class="btn btn-submit-custom w-100">Let's start!</button>
                </form>

                <!-- <div class="social-icons-container">
                    <a href="{{-- url('/auth/facebook') --}}#" class="social-icon facebook-icon" aria-label="Login with Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.407.593 24 1.324 24h11.494v-9.294H9.689v-3.621h3.129V8.41c0-3.1 1.893-4.785 4.659-4.785 1.325 0 2.463.099 2.795.142v3.24h-1.918c-1.504 0-1.795.715-1.795 1.763v2.309h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.324V1.324C24 .593 23.407 0 22.676 0z"/></svg>
                    </a>
                    <a href="{{-- url('/auth/google') --}}#" class="social-icon" aria-label="Login with Google">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google logo">
                    </a>
                </div> -->

                <p class="account-prompt mt-4">
                    Don't have an account? <a href="{{ route('resto.signup.form') }}">Sign up</a>
                </p>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
