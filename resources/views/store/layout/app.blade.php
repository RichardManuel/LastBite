<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <!-- <link rel="stylesheet" href="{{ asset('css/styledetail.css') }}"> -->

    {{-- Untuk CSS spesifik per halaman (opsional) --}}
    @stack('styles')
</head>

<body>
    <!-- Header / Navbar -->
    <div class="flex justify-between items-center p-2" style="background-color:#F3C148">
        <div class="flex items-center space-x-2 ml-4">
            <img src="{{ asset('images/logo lastbite putih.png') }}" alt="Logo" class="h-12"> 
        </div>
        <nav class="text-white font-medium mr-10" style="display: flex; gap: 60px;">
            <a href="#" class="hover:underline font-">Order</a>
            <a href="#" class="hover:underline">Stocks</a>
            <a href="#" class="hover:underline">Profile</a>
        </nav>
    </div>


    {{-- "Slot" untuk konten utama dari setiap halaman --}}
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-section text-white pt-5 pb-4" style="background-color: #F3C148;">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-lg-3 col-md-4 text-center text-md-start mb-3 mb-md-0">
                    <img src="{{ asset('images/LastBite.png') }}" alt="LastBite Logo White"
                        class="footer-logo-main img-fluid h-5">
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


    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- Custom Script (menggunakan helper asset()) -->
    <script src="{{ asset('js/script.js') }}"></script>

    {{-- Untuk script spesifik per halaman (opsional) --}}
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const clearSearchButton = document.getElementById('clearSearchButton');
            const searchInput = document.getElementById('searchInput');

            // Cek apakah tombol dan inputnya ada di halaman ini
            if (clearSearchButton && searchInput) {

                // Hanya tampilkan tombol clear jika ada isinya
                if (searchInput.value === '') {
                    clearSearchButton.style.display = 'none';
                }
                searchInput.addEventListener('input', function() {
                    clearSearchButton.style.display = this.value ? 'block' : 'none';
                });

                // Tambahkan event listener untuk klik
                clearSearchButton.addEventListener('click', function(event) {
                    // Mencegah perilaku default (reset) dari tombol
                    event.preventDefault();

                    // Buat objek URL dari alamat saat ini
                    const currentUrl = new URL(window.location.href);

                    // Hapus parameter 'query' dari URL
                    currentUrl.searchParams.delete('query');

                    // Arahkan browser ke URL baru yang sudah bersih
                    window.location.href = currentUrl.toString();
                });
            }
        });
    </script>
</body>

</html>
