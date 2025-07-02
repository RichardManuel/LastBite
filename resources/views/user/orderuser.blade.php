<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - LastBite</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
    <link href="{{ asset('bootstrap-5.3.6-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            background-color: #FBF5EC; /* custom-beige */
            color: #374151; /* custom-dark-text */
        }
        .font-serif-display {
             font-family: 'Georgia', 'Times New Roman', serif;
        }
        .bg-custom-green {
            background-color: #3A6B50 !important;
        }
        .text-custom-green {
            color: #3A6B50 !important;
        }
        .bg-custom-light-green-card {
            background-color: #EEF6DF !important;
        }
        .border-custom-green-border {
            border-color: #C8E6C9 !important;
        }
        .text-custom-light-text {
            color: #6B7280 !important;
        }
        .text-custom-dark-text {
            color: #374151 !important;
        }

        /* Navbar styling */
        .navbar-custom .nav-link {
            color: white;
            font-size: 0.875rem; /* text-sm */
        }
        @media (min-width: 768px) { /* md breakpoint */
            .navbar-custom .nav-link {
                font-size: 1rem; /* text-base */
            }
        }
        .navbar-custom .nav-link:hover {
            color: #D1D5DB; /* hover:text-gray-300 */
        }
        .navbar-custom .nav-link.fw-semibold {
            font-weight: 600;
        }
        .navbar-custom .btn-signup {
            background-color: white;
            color: #3A6B50;
            font-size: 0.75rem; /* text-xs */
            padding: 0.25rem 0.5rem; /* px-2 py-1 */
        }
        @media (min-width: 640px) { /* sm breakpoint */
            .navbar-custom .btn-signup {
                font-size: 0.875rem; /* sm:text-sm */
                padding: 0.375rem 0.75rem; /* sm:px-3 sm:py-1.5 */
            }
        }
        @media (min-width: 768px) { /* md breakpoint */
            .navbar-custom .btn-signup {
                padding: 0.5rem 1rem; /* md:px-4 md:py-2 */
            }
        }
        .navbar-custom .btn-signup:hover {
            background-color: #E5E7EB; /* hover:bg-gray-200 */
        }
        .navbar-custom .navbar-brand img {
            height: 2rem; /* h-8 */
        }
        @media (min-width: 640px) { /* sm breakpoint */
            .navbar-custom .navbar-brand img {
                height: 2.5rem; /* sm:h-10 */
            }
        }


        /* Order card styling */
        .order-card {
            border-radius: 0.75rem; /* rounded-xl */
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* shadow-sm */
        }
        .order-card .text-xs {
            font-size: 0.75rem; /* text-xs */
            text-transform: uppercase;
            letter-spacing: 0.05em; /* tracking-wider */
        }
        .order-card .text-base {
            font-size: 1rem; /* text-base */
        }

        /* Footer styling */
        .footer-logo img {
            height: 2.5rem; /* h-10 */
        }
        .footer-big-logo img {
            height: 4rem; /* h-16 */
            opacity: 0.3;
        }
        @media (min-width: 768px) { /* md breakpoint */
            .footer-big-logo img {
                height: 5rem; /* md:h-20 */
            }
        }
        .footer-social-icon {
            width: 1.5rem; /* w-6 */
            height: 1.5rem; /* h-6 */
        }

        /* Custom hover for tab buttons */
        .btn.hover-bg-gray-200:hover {
            background-color: #E5E7EB !important; /* Tailwind gray-200 */
        }
        .btn.hover-text-custom-green:hover {
            color: #3A6B50 !important;
        }

    </style>
</head>
<body class="bg-custom-beige text-custom-dark-text">

    <!-- Navbar -->
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-custom-green shadow-sm py-3 navbar-custom">
        <div class="container"> -->
            <!-- Left Nav Items -->
            <!-- <div class="navbar-nav me-auto">
                <a class="nav-link" href="#">Home</a>
                <a class="nav-link mx-lg-3 mx-2" href="#">Eatery</a>
                <a class="nav-link fw-semibold" href="#">Order</a>
            </div> -->

            <!-- Center Section: Logo -->
            <!-- <a class="navbar-brand mx-auto" href="/">
                <img src="img/logo lastbite putih 1.png" alt="LastBite Logo">
            </a> -->

            <!-- Right Section: Auth Links -->
            <!-- <div class="navbar-nav ms-auto">
                <a class="nav-link me-2 me-sm-3" href="#">Login</a>
                <a href="#" class="btn btn-sm btn-signup rounded-md fw-medium text-nowrap">Restaurant Sign Up</a>
            </div>
        </div>
    </nav> -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="container mt-4 mb-4 mt-md-5 mb-md-5 px-4">

        <div class="mb-4 mb-md-5">
            <h1 class="display-4 font-serif-display text-dark">Order.</h1> 
            <p class="text-custom-light-text mt-1 fs-5">Grab your meal before it's gone!</p>
        </div>

        <div>
            <!-- Tab Navigation -->
            <div class="d-flex justify-content-end gap-2 gap-sm-3 mb-1"> 
                <button class="btn btn-sm bg-custom-green text-white shadow-sm fw-semibold">All Order</button>
                <button class="btn btn-sm text-custom-light-text hover-bg-gray-200 hover-text-custom-green fw-medium">Ongoing</button>
                <button class="btn btn-sm text-custom-light-text hover-bg-gray-200 hover-text-custom-green fw-medium">Completed</button>
            </div>
            <hr class="my-3 border-dark"> 
        </div>


        <!-- Order List -->
        <div class="mt-4">
            <!-- Order Item 1 -->
            <div class="bg-custom-light-green-card border border-custom-green-border p-3 p-md-4 shadow-sm order-card mb-3">
                <div class="row g-3">
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Order ID</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">#123323</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Restaurant</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">Dunkin Donuts</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md ">
                        <p class="text-xs text-custom-light-text">Payment</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">COD</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Status</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">Taken</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Total</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">Rp 30.000,00</p>
                    </div>
                </div>
            </div>

            <!-- Order Item 2 -->
            <div class="bg-custom-light-green-card border border-custom-green-border p-3 p-md-4 shadow-sm order-card mb-3">
                <div class="row g-3">
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Order ID</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">#232321</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Restaurant</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">Krispy Kreme</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Payment</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">Credit Card</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Status</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">Pending</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Total</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">Rp 21.000,00</p>
                    </div>
                </div>
            </div>

            <!-- Order Item 3 -->
            <div class="bg-custom-light-green-card border border-custom-green-border p-3 p-md-4 shadow-sm order-card mb-3">
                <div class="row g-3">
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Order ID</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">#213344</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Restaurant</p>
                        <p class="text-base font-semibold text-custom-dark-text mt-1">Holland</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Payment</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">COD</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Status</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">Cancelled</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Total</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">Rp 43.000,00</p>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer Placeholder -->
    <footer class="bg-custom-green text-white mt-5 py-5">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left side of footer -->
                <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                    <div class="d-inline-block mb-2 footer-logo">
                        <img src="img/Logo LastBite.png" alt="LastBite Logo">
                    </div>
                    <p class="h3 font-serif-display mb-3">Thank you for your curiosity.</p>
                    <div class="d-flex justify-content-center justify-content-md-start gap-3 mb-3">
                        <a href="#" class="text-white text-decoration-none">Home</a>
                        <a href="#" class="text-white text-decoration-none">Eatery</a>
                        <a href="#" class="text-white text-decoration-none">Order</a>
                    </div>
                </div>
                <!-- Right side of footer -->
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-1 fw-semibold">Follow Us</p>
                    <p class="small text-white-50 mb-2">Yes, we are social</p>
                    <div class="d-flex justify-content-center justify-content-md-end gap-3">
                        <a href="#" aria-label="Instagram" class="text-white-50 hover-text-white">
                            <svg class="footer-social-icon" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.012-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.48 3.735c.636-.247 1.363.416 2.427-.465C8.93 2.013 9.284 2 12.315 2zm0 1.623c-2.383 0-2.706.01-3.644.052-.93.042-1.484.193-1.94.372a3.272 3.272 0 00-1.185.77A3.272 3.272 0 004.37 5.99c-.179.456-.33 1.01-.372 1.94-.043.938-.052 1.261-.052 3.644s.01 2.706.052 3.644c.042.93.193 1.484.372 1.94a3.272 3.272 0 00.77 1.185 3.272 3.272 0 001.185.77c.456.179 1.01.33 1.94.372.938.043 1.261.052 3.644.052s2.706-.01 3.644-.052c.93-.042 1.484-.193-1.94-.372a3.272 3.272 0 001.185-.77 3.272 3.272 0 00.77-1.185c.179-.456.33-1.01.372-1.94.043-.938-.052-1.261.052-3.644s-.01-2.706-.052-3.644c-.042-.93-.193-1.484-.372-1.94a3.272 3.272 0 00-.77-1.185 3.272 3.272 0 00-1.185-.77c-.456-.179-1.01-.33-1.94-.372C15.022 3.633 14.698 3.623 12.315 3.623zM12 7.118c-2.693 0-4.882 2.189-4.882 4.882s2.189 4.882 4.882 4.882 4.882-2.189 4.882-4.882S14.693 7.118 12 7.118zm0 8.138c-1.794 0-3.256-1.462-3.256-3.256s1.462-3.256 3.256-3.256 3.256 1.462 3.256 3.256S13.794 15.256 12 15.256zm4.908-8.212a1.157 1.157 0 100-2.313 1.157 1.157 0 000 2.313z" clip-rule="evenodd"></path></svg>
                        </a>
                        <a href="#" aria-label="Facebook" class="text-white-50 hover-text-white">
                            <svg class="footer-social-icon" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path></svg>
                        </a>
                         <a href="#" aria-label="Youtube" class="text-white-50 hover-text-white">
                            <svg class="footer-social-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0C.488 3.411 0 5.936 0 12s.488 8.589 4.385 8.816c3.599.245 11.626.246 15.23 0C23.512 20.589 24 18.064 24 12s-.488-8.589-4.385-8.816ZM9.757 15.43V8.57l6.52 3.43-6.52 3.43Z"></path></svg>
                        </a>
                        <a href="#" aria-label="Medium" class="text-white-50 hover-text-white">
                           <svg class.="footer-social-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M2.25 12c0-.69.196-1.342.557-1.904L1.666 3h4.447l1.484 7.063L9.903 3h4.447l2.668 11.393L18.25 3h4.083l-1.484 7.096c.361.562.557 1.213.557 1.904 0 2.062-1.335 3.75-3.002 3.75-1.667 0-3.002-1.688-3.002-3.75 0-.84.28-1.608.75-2.25l-1.42-6.04L12.446 18H9.995L7.91 9.75c.47.642.75 1.41.75 2.25 0 2.062-1.336 3.75-3.002 3.75C4.021 15.75 2.25 14.062 2.25 12Z"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary-subtle my-4 opacity-50">
            <div class="text-center text-md-start">
                <p class="small text-white-50">© 2023 LastBite Inc. All rights reserved</p>
            </div>
            <div class="mt-5 text-center footer-big-logo">
                 <img src="img/Logo LastBite.png" alt="LastBite" class="mx-auto">
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->
    <script src="{{ asset('bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>