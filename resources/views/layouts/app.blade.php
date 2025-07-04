<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Last Bite')</title> {{-- Menambahkan title dinamis --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
     {{-- ... meta tags, title, link ke app.css, Bootstrap, dll. ... --}}
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}"> {{-- CSS global --}}

    @stack('styles') {{-- Tempat CSS spesifik halaman dimasukkan --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body>

    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-custom-green shadow-sm py-3 navbar-custom">
    <div class="container position-relative">
        <!-- Left Nav Items -->
        <div class="navbar-nav me-auto">
            <a class="nav-link" href="#">Home</a>
            <a class="nav-link mx-lg-3 mx-2" href="#">Eatery</a>
            <a class="nav-link" href="#">Order</a>
        </div>

        <!-- Center Logo -->
        <a class="navbar-brand position-absolute start-50 translate-middle-x" href="/">
            <img src="{{ asset('image/logo lastbite putih 1.svg') }}" alt="LastBite Logo">
        </a>

        <!-- Right Auth Links -->
        <div class="navbar-nav ms-auto">
            <img src="{{ asset('image/akun.svg') }}" alt="akun">
        </div>
    </div>
</nav>


    @yield('content') {{-- Konten utama halaman akan dimuat di sini --}}

   <footer class="footer-section text-white pt-5 pb-4">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-lg-3 col-md-4 text-center text-md-start mb-3 mb-md-0">
                    <img src="{{ asset('image/logo lastbite putih 1.png') }}" alt="LastBite Logo"  class="footer-logo-main img-fluid">
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
</body>
</html>