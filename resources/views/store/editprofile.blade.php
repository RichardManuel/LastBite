<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - LastBite Eatery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --brand-yellow-navbar: #F5C563;
            --brand-orange-accent: #F9A826;
            --brand-text-dark: #3A2E39;
            --brand-text-light: #584957;
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

        h1 {
            font-family: 'Playfair Display', serif;
        }

        .form-section {
            padding: 3rem 1rem;
            flex-grow: 1;
        }

        .restaurant-photo-preview {
            max-height: 250px;
            object-fit: cover;
            width: 100%;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .btn-warning {
            background-color: var(--brand-orange-accent);
            border: none;
        }

        .btn-warning:hover {
            background-color: #e0931f;
        }

        .footer-custom {
            background-color: var(--footer-bg);
            color: var(--footer-text);
            padding: 3rem 0;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-sm navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/lastbite_logo_eatery_navbar.png') }}" alt="LastBite Logo" height="28">
        </a>
        <div class="collapse navbar-collapse" id="navbarNavMain">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">Order</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Stocks</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('resto.profile.show') }}">Profile</a></li>
                @auth
                <li class="nav-item">
                    <form method="POST" action="{{ route('resto.logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link" style="color: var(--brand-text-dark)">Logout</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Edit Profile Form -->
<div class="container form-section">
    <h1 class="text-center mb-5">Restaurant Profile</h1>

    <form action="{{ route('resto.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-5">
            <!-- Kiri -->
            <div class="col-md-6">
                <label class="form-label">Restaurant Photos</label>
                <img src="{{ asset('storage/' . $restaurant->restaurant_picture_path) }}" class="restaurant-photo-preview" alt="Restaurant Photo">
                <input type="file" name="restaurant_picture" class="form-control mb-3">

                <div class="mb-3">
                    <label class="form-label">Restaurant</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $restaurant->name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{{ old('location', $restaurant->location) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Operational Time</label>
                    <input type="text" name="operational_hours" class="form-control" value="{{ old('operational_hours', $restaurant->operational_hours) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $restaurant->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Type of food sold</label>
                    <input type="text" name="food_type" class="form-control" value="{{ old('food_type', $restaurant->food_type) }}">
                </div>
            </div>

            <!-- Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Applicant Name</label>
                    <input type="text" name="applicant_name" class="form-control" value="{{ old('applicant_name', $restaurant->applicant_name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $restaurant->email) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Telephone</label>
                    <input type="text" name="telephone" class="form-control" value="{{ old('telephone', $restaurant->telephone) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Bank Account</label>
                    <input type="text" name="account_bank" class="form-control" value="{{ old('account_bank', $restaurant->account_bank) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Account Name</label>
                    <input type="text" name="bank_account_name" class="form-control" value="{{ old('bank_account_name', $restaurant->bank_account_name) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Pricing</label>
                    <input type="text" name="pricing_tier" class="form-control" value="{{ old('pricing_tier', $restaurant->pricing_tier) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Best Before</label>
                    <input type="text" name="best_before" class="form-control" value="{{ old('best_before', $restaurant->best_before ?? '') }}">
                </div>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-warning px-4">Save</button>
        </div>
    </form>
</div>

<!-- Footer -->
<footer class="footer-custom mt-auto">
    <div class="container">
        <div class="footer-logo">
            <img src="{{ asset('img/lastbite_logo_eatery_navbar.png') }}" alt="LastBite Footer Logo" height="40">
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
