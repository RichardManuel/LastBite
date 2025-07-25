<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $restaurant->name ?? 'Restaurant Profile' }} - LastBite Eatery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --brand-yellow-navbar: #F5C563;
            --brand-orange-accent: #F9A826;
            --brand-text-dark: #3A2E39;
            --brand-text-light: #584957;
            --profile-bg: #FAF7F2;
            /* Warna background area profil seperti di gambar */
            --profile-border: #EAE0CC;
            --rating-bg: #FFF7E6;
            --rating-border: #FFECCF;
            --rating-star: #FFC107;
            --font-serif-display: 'Playfair Display', serif;
            --font-sans-body: 'Roboto', sans-serif;
            --footer-bg: #F5C563;
            --footer-text: #3A2E39;
        }

        body {
            font-family: 'Instrument Serif', serif;
            background-color: #FFFFFF;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: var(--brand-text-dark);
        }

        /* Navbar My Eatery Styles */
        .navbar-eatery {
            background-color: #F3C148;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* shadow-md */
        }

        .navbar-eatery .navbar-brand img {
            height: 50px;
            /* Sesuaikan dengan tinggi logo LastBite di navbar Eatery */

        }

        .navbar-eatery .nav-link {
            color: #F9F1E4 !important;
            /* Teks navbar berwarna gelap */
            font-family: 'Instrument Sans';
            font-weight: 600;
            padding-left: 4rem;
            padding-right: 2rem;
        }

        .navbar-eatery .nav-link:hover,
        .navbar-eatery .nav-link.active {
            color: var(--brand-green) !important;
            /* Warna hijau untuk hover/active */
        }

        .profile-banner {
            height: 300px;
            /* Sesuaikan tinggi banner */
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .profile-banner::after {
            /* Overlay gelap tipis untuk kontras teks jika ada teks di banner */
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .main-content {
            flex-grow: 1;
            padding-top: 0;
            /* Banner menempel ke atas */
        }

        .profile-details-card {
            background-color: var(--profile-bg);
            border: 1px solid var(--profile-border);
            border-radius: 12px;
            /* Lebih rounded */
            padding: 2rem;
            margin-top: -80px;
            /* Card menimpa banner sedikit */
            position: relative;
            z-index: 10;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            max-width: 800px;
            /* Lebar card */
            margin-left: auto;
            margin-right: auto;
        }

        .profile-details-card h1 {
            font-family: var(--font-serif-display);
            color: var(--brand-text-dark);
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            /* text-align: center; Jika ingin judul di tengah card */
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            /* Kolom responsif */
            gap: 1.5rem 2rem;
            /* Jarak antar item */
            margin-bottom: 1.5rem;
        }

        .info-item {
            text-align: left;
        }

        .info-item .info-label {
            font-size: 0.8rem;
            color: var(--brand-text-light);
            margin-bottom: 0.2rem;
            display: block;
            font-weight: 500;
            text-transform: uppercase;
            /* Seperti di gambar */
        }

        .info-item .info-value {
            font-size: 0.95rem;
            color: var(--brand-text-dark);
            font-weight: 500;
            /* Teks value lebih tebal */
        }

        .info-item .info-value.description {
            font-size: 0.9rem;
            line-height: 1.6;
            color: var(--brand-text-light);
            /* Deskripsi bisa lebih terang */
            font-weight: 400;
        }

        .rating-badge {
            background-color: var(--rating-bg);
            border: 1px solid var(--rating-border);
            color: var(--brand-text-dark);
            padding: 0.3rem 0.6rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
        }

        .rating-badge .bi-star-fill {
            color: var(--rating-star);
            margin-right: 0.2rem;
            font-size: 0.8rem;
            /* Sedikit lebih kecil */
        }

        .rating-count {
            font-size: 0.75rem;
            color: var(--brand-text-light);
            display: block;
            /* Di bawah badge */
            margin-top: 0.2rem;
        }


        .btn-edit-custom {
            background-color: var(--brand-orange-accent);
            color: white;
            font-weight: 500;
            padding: 0.5rem 1.2rem;
            border-radius: 0.25rem;
            font-size: 0.9rem;
            border: none;
            text-decoration: none;
            /* Jika berupa link <a> */
        }

        .btn-edit-custom:hover {
            background-color: #e0931f;
            color: white;
        }

        /* Footer Styles (Sama seperti halaman lain) */
        .footer-custom {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            padding: 3rem 0;
            text-align: center;
            margin-top: 3rem;
            /* Beri jarak dari konten */
        }

        .footer-custom .footer-logo img {
            height: 40px;
            margin-bottom: 1rem;
        }

        .footer-custom h5 {
            font-family: var(--font-serif-display);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .footer-custom .nav-link {
            color: var(--footer-text);
            padding: 0.25rem 0.75rem;
            font-size: 0.9rem;
        }

        .footer-custom .nav-link:hover {
            opacity: 0.8;
        }

        .footer-custom .social-icons a {
            color: var(--footer-text);
            font-size: 1.3rem;
            margin: 0 0.5rem;
        }

        .footer-custom .social-icons a:hover {
            opacity: 0.8;
        }

        .footer-custom .copyright {
            font-size: 0.8rem;
            margin-top: 2rem;
            opacity: 0.7;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-eatery">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/logo lastbite putih 1.png') }}" alt="LastBite Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavMain"
                aria-controls="navbarNavMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavMain">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-4">
                        <a class="nav-link" href="#">Order</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="#">Stocks</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link active" href="{{ route('resto.profile.show') }}">Profile</a>
                        <!-- Asumsi route ini ada -->
                    </li>
                    @auth
                        <li class="nav-item me-4">
                            <form method="POST" action="{{ route('resto.logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content for Restaurant Profile Display -->
    <div class="container text-center mt-5">
        <h1>Your Eatery is Waiting for Approval</h1>
        <p class="lead">Thank you for submitting your details.</p>
        <p>Your eatery profile is currently under review by our team. You will be notified once it's approved.</p>
    </div>

    <!-- Footer -->
    <footer class="footer-custom mt-auto">
        <div class="container">
            <div class="footer-logo">
                <img src="{{ asset('img/lastbite_logo_eatery_navbar.png') }}" alt="LastBite Footer Logo">
            </div>
            <h5>Thank you for your curiosity.</h5>
            <ul class="nav justify-content-center mb-3">
                <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Eatery</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Order</a></li>
            </ul>
            <div class="social-icons mb-3">
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
                <a href="#"><i class="bi bi-medium"></i></a>
            </div>
            <div class="copyright">
                © {{ date('Y') }} LastBite Inc. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
