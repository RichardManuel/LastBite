<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Judul halaman akan dinamis --}}
    <title>@yield('title') | Last Bite</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Instrument+Serif:ital@0;1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styledetail.css') }}">

    <style>
        :root {
            --brand-yellow-navbar: #F5C563;
            --brand-orange-accent: #F9A826;
            --brand-text-dark: #ffffffff;
            --footer-bg: #F5C563;
            --footer-text: #ffffffff;
        }

        body {
            font-family: 'Instrument Serif', serif;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: var(--brand-text-dark);
        }

        /* Aturan CSS untuk memberikan garis bawah pada tautan yang memiliki kelas 'active' */
        .nav-link.active,
        .footer-nav-link.active {
            text-decoration: underline;
            text-underline-offset: 4px;
        }

        .navbar-custom {
            background-color: var(--brand-yellow-navbar);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            min-height: 10vh;
            padding: 0 5rem;
        }

        .navbar-custom .nav-link {
            color: white !important;
            font-weight: 700;
            font-size: 1.1em;
            font-family: 'Instrument Sans', sans-serif;
            color: white;
        }

        .navbar-expand-lg .navbar-nav {
            gap: 1rem;
        }

        .navbar-brand img {
            height: 100px;
            /* Atur tinggi logo sesuai kebutuhan */
            margin-right: 10rem;
        }

        .footer-custom {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            padding: 3rem 0;
            text-align: center;
        }

        .footer-section {
            background-color: #F5C563;
        }
    </style>

    {{-- Untuk CSS spesifik per halaman (opsional) --}}
    @stack('styles')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid navbar-container">

            <div class="collapse navbar-collapse me-auto" id="navbarNavMain">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('resto.orders.index') ? 'active' : '' }}"
                            href="{{ route('resto.orders.index') }}">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('resto.stock.manage') ? 'active' : '' }}"
                            href="{{ route('resto.stock.manage') }}">Stocks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('resto.profile.show') ? 'active' : '' }}"
                            href="{{ route('resto.profile.show') }}">Profile</a>
                    </li>
                </ul>
            </div>

            <a class="navbar-brand mx-auto" href="{{ route('home.index') }}">
                <img src="{{ asset('img/LastBite.png') }}" alt="LastBite Logo">
            </a>

            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavMain"
                aria-controls="navbarNavMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNavMain">
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <form method="POST" action="{{ route('resto.logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link"
                                    style="color: var(--brand-text-dark)">Logout</button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('resto.login.form') ? 'active' : '' }}"
                                href="{{ route('resto.login.form') }}">Login</a>
                        </li>
                    @endguest
                </ul>
            </div>

        </div>
    </nav>


    {{-- "Slot" untuk konten utama dari setiap halaman --}}
    <main>
        @yield('content')
    </main>

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
                        <a href="{{ route('resto.orders.index') }}"
                            class="footer-nav-link {{ request()->routeIs('resto.orders.index') ? 'active' : '' }}">Order</a>
                        <a href="{{ route('resto.stock.manage') }}"
                            class="footer-nav-link {{ request()->routeIs('resto.stock.manage') ? 'active' : '' }}">Stock</a>
                        <a href="{{ route('resto.profile.show') }}"
                            class="footer-nav-link {{ request()->routeIs('resto.profile.show') ? 'active' : '' }}">Profile</a>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    @stack('scripts')

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