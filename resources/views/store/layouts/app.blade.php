<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LastBite')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            --brand-yellow-navbar: #F5C563;
            --brand-orange-accent: #F9A826;
            --brand-text-dark: #3A2E39;
            --footer-bg: #F5C563;
            --footer-text: #3A2E39;
        }

        body {
            font-family: 'Instrument Serif', serif;
            background-color: #fff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            color: var(--brand-text-dark);
        }

        .navbar-custom {
            background-color: var(--brand-yellow-navbar);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-custom .nav-link {
            color: var(--brand-text-dark) !important;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .footer-custom {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            padding: 3rem 0;
            text-align: center;
        }
    </style>

    @stack('styles')
</head>
<body>


<!-- Navbar -->
<nav class="navbar navbar-expand-sm navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo lastbite putih 1.png') }}" alt="LastBite Logo" height="28">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavMain" aria-controls="navbarNavMain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavMain">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('resto.orders.index') }}">Order</a></li>
                <a class="nav-link" href="{{ route('resto.stock.manage') }}">Stocks</a>
                <li class="nav-item"><a class="nav-link" href="{{ route('resto.profile.show') }}">Profile</a></li>
                @auth
                <li class="nav-item">
                    <form method="POST" action="{{ route('resto.logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" style="color: var(--brand-text-dark)">Logout</button>
                    </form>
                </li>
                @endauth
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('resto.login.form') }}">Login</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="flex-grow-1">
    @yield('content')
</main>

<!-- Footer -->
<footer class="footer-custom mt-auto">
    <div class="container">
        <div class="footer-logo mb-2">
            <img src="{{ asset('img/logo lastbite putih 1.png') }}" alt="LastBite Footer Logo" height="40">
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
@stack('scripts')
</body>
</html>
