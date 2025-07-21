{{-- File: resources/views/layouts/app.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'LastBite Admin')</title>

    {{-- Link CDN dan CSS Kustom (tidak perlu diubah) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/RestoApplicationStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/RestoManagementStyle.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    {{-- ========================================================= --}}
    {{-- === TEMPELKAN KODE NAVBAR ANDA DI SINI === --}}
    {{-- ========================================================= --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <div class="navbar-nav me-auto">
                {{-- Gunakan nama rute, bukan URL manual --}}
                <a class="nav-link {{ request()->is('admin/restaurants*') ? 'active' : '' }}" href="{{ route('admin.restaurants.index') }}">Resto Application</a>
                {{-- <a class="nav-link {{ request()->is('admin/management*') ? 'active' : '' }}" href="">Resto Management</a> --}}
            </div>
            <a class="navbar-brand navbar-custom-logo" href="#">
                {{-- Pastikan gambar LastBite.png ada di folder public/images --}}
                <img src="{{ asset('images/LastBite.png') }}" alt="Last Bite Logo">
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="loginpage.blade.php">Log out <i class="bi bi-box-arrow-right"></i></a>
            </div>
        </div>
    </nav>
    {{-- ========================================================= --}}


    {{-- Konten utama halaman akan dimuat di sini --}}
    <main>
        @yield('content')
    </main>


    <footer class="footer-section text-white pt-5 pb-4">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-lg-3 col-md-4 text-center text-md-start mb-3 mb-md-0">
                    <img src="{{asset('images/LastBite.png')}}" alt="LastBite Logo White" class="footer-logo-main img-fluid">
                </div>

                <div class="col-lg-6 col-md-4 text-center mb-3 mb-md-0">
                    <p class="footer-thank-you-text mb-2">Thank you for your curiosity.</p>
                    <nav class="footer-nav">
                        <a href="home.html" class="footer-nav-link">Home</a>
                        <a href="eatery.html" class="footer-nav-link">Eatery</a>
                        <a href="order.html" class="footer-nav-link">Order</a>
                    </nav>
                </div>

                <div class="col-lg-3 col-md-4 text-end">
                    <p class="footer-follow-us-title mb-1"><strong>Follow Us</strong></p>
                    <p class="footer-social-subtext mb-2">Yes, we are social</p>
                    <div class="social-icons-footer">

                        <a href="#" class="social-icon-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon-link"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-icon-link" title="Email Us"><i class="fas fa-envelope"></i></a>

                    </div>
                </div>
            </div>


            <hr class="footer-divider">


            <div class="row">
                <div class="col text-center mt-3 mb-5">
                    <p class="copyright-text-footer">© 2025 LastBite Inc. All rights reserved</p>
                </div>
            </div>
        </div>


        <div class="footer-background-text-container">
            <div class="footer-logo-large-bg">LastBite.</div>
        </div>
    </footer>
    {{-- ========================================================= --}}


    {{-- Link JavaScript (tidak perlu diubah) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
