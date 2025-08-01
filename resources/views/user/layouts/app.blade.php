<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Judul halaman akan dinamis --}}
    <title>@yield('title') | Last Bite</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Instrument+Serif:ital@0;1&display=swap"
        rel="stylesheet">

    <!-- Google Fonts (tetap sama) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom Styles (menggunakan helper asset()) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styledetail.css') }}">

    {{-- Untuk CSS spesifik per halaman (opsional) --}}
    @stack('styles')
</head>

<body>

    <!-- Header / Navbar -->
    <nav
        class="navbar navbar-expand-lg navbar-dark shadow-sm py-3 navbar-custom
        @if (Route::is('home.index')) navbar-transparent
        @else
            bg-custom-green @endif
    ">
        <div class="container">
            <!-- Left Nav Items -->
            <div class="navbar-nav me-auto">
                {{-- Gunakan helper url() atau route() untuk link --}}
                <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                <a class="nav-link mx-lg-3 mx-2" href="{{ route('user.eatery') }}">Eatery</a>
                <a class="nav-link" href="{{ route('order') }}">Order</a>
            </div>

            <!-- Center Section: Logo -->
            <a class="navbar-brand mx-auto" href="{{ route('home.index') }}">
                {{-- Gunakan helper asset() untuk gambar --}}
                <img src="{{ asset('img/LastBite.png') }}" alt="LastBite Logo">
            </a>

            <!-- Right Section: Auth Links -->
            <div class="navbar-nav ms-auto">
                @auth
                    {{-- Jika sudah login --}}
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('/user/profile') }}">Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    {{-- Jika belum login --}}
                    <a class="nav-link me-2 me-sm-3" href="{{ route('login') }}">Login</a>
                    <a href="{{ route('resto.login.form') }}"
                        class="btn btn-sm btn-signup rounded-md fw-medium text-nowrap">Restaurant Sign Up</a>
                @endauth
            </div>

        </div>
    </nav>

    {{-- "Slot" untuk konten utama dari setiap halaman --}}
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-section text-white pt-5 pb-4">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-lg-3 col-md-4 text-center text-md-start mb-3 mb-md-0">
                    <img src="{{ asset('img/LastBite.png') }}" alt="LastBite Logo White"
                        class="footer-logo-main img-fluid">
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


    <!-- Bootstrap JS Bundle (only one, correct version) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Script (menggunakan helper asset()) -->
    <script src="{{ asset('js/script.js') }}"></script>

    {{-- Untuk script spesifik per halaman (opsional) --}}
    @stack('scripts')

    <!-- Clear Search Button Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const clearSearchButton = document.getElementById('clearSearchButton');
            const searchInput = document.getElementById('searchInput');

            if (clearSearchButton && searchInput) {
                clearSearchButton.style.display = searchInput.value ? 'block' : 'none';

                searchInput.addEventListener('input', function() {
                    clearSearchButton.style.display = this.value ? 'block' : 'none';
                });

                clearSearchButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    const currentUrl = new URL(window.location.href);
                    currentUrl.searchParams.delete('query');
                    window.location.href = currentUrl.toString();
                });
            }
        });
    </script>
</body>

</html>
