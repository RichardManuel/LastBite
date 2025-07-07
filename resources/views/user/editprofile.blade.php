<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - LastBite</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Bootstrap CSS (Lokal) -->
    {{-- <link href="{{ asset('bootstrap-5.3.6-dist/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
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
        .border-custom-green {
            border-color: #3A6B50 !important;
        }
        .bg-custom-yellow-button {
            background-color: #FACC15 !important; /* yellow-400 equivalent */
            color: #1f2937 !important; /* Contoh warna teks gelap untuk kontras */
        }
        .bg-custom-yellow-button:hover {
            background-color: #FBBF24 !important; /* yellow-500 equivalent */
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
            font-size: 0.875rem;
        }
        @media (min-width: 768px) {
            .navbar-custom .nav-link {
                font-size: 1rem;
            }
        }
        .navbar-custom .nav-link:hover {
            color: #D1D5DB;
        }
        .navbar-custom .nav-link.fw-semibold {
            font-weight: 600;
        }
        .navbar-custom .btn-signup {
            background-color: white;
            color: #3A6B50;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
        @media (min-width: 640px) {
            .navbar-custom .btn-signup {
                font-size: 0.875rem;
                padding: 0.375rem 0.75rem;
            }
        }
        @media (min-width: 768px) {
            .navbar-custom .btn-signup {
                padding: 0.5rem 1rem;
            }
        }
        .navbar-custom .btn-signup:hover {
            background-color: #E5E7EB;
        }
        .navbar-custom .navbar-brand img {
            height: 2rem;
        }
        @media (min-width: 640px) {
            .navbar-custom .navbar-brand img {
                height: 2.5rem;
            }
        }

        /* Profile Specific Styles */
        .profile-image {
            width: 12rem;
            height: 12rem;
        }
        @media (min-width: 768px) {
            .profile-image {
                width: 14rem;
                height: 14rem;
            }
        }
        /* Custom styling untuk input agar sesuai dengan gambar referensi */
        .form-control {
            background-color: #E9ECEF; /* Warna abu-abu muda seperti di gambar */
            border: 1px solid #CED4DA; /* Border standar Bootstrap */
        }
        .form-control:focus {
            background-color: #E9ECEF;
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
        }


        /* Footer styling */
        .footer-logo img {
            height: 2.5rem;
        }
        .footer-big-logo img {
            height: 4rem;
            opacity: 0.3;
        }
        @media (min-width: 768px) {
            .footer-big-logo img {
                height: 5rem;
            }
        }
        .footer-social-icon {
            width: 1.5rem;
            height: 1.5rem;
        }
        .hover-text-white:hover {
            color: white !important;
        }

    </style>
</head>
<body class="bg-custom-beige text-custom-dark-text">

    @include('partials.navbar')

    <!-- Main Content -->
    <main class="container mt-4 mb-4 py-md-5 px-4">

        <div class="mb-4 mb-md-5">
            <h1 class="display-5 display-md-4 font-serif-display text-dark ">Edit Profile.</h1>
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-md-5 g-4">

            <!-- Left Column: Profile Image & Upload -->
            <div class="col-md-3 d-flex flex-column align-items-center align-items-md-start">
                <div class="position-relative mb-3 profile-image">
                    @if($user->img_path)
                    <img src="{{ asset('storage/uploads/' . ($user->img_path)) }}" 
                        alt="User Profile Image" 
                        class="rounded w-100 h-100 object-fit-cover border border-4 border-custom-green shadow-lg">
                    @else
                        <img src="{{ asset('img/defaultprofile.jpg') }}" alt="Default Profile Image" class="rounded w-100 h-100 object-fit-cover border border-4 border-custom-green shadow-lg">
                    @endif
                </div>

                <!-- Custom styled label that acts as upload button -->
                <label class="btn bg-custom-yellow-button text-dark px-3 py-2 rounded-md small fw-medium d-flex align-items-center" for="img_path">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image me-2" viewBox="0 0 16 16">
                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z"/>
                    </svg>
                    <span>Change Profile Image</span>
                </label>
                <input type="file" name="img_path" id="img_path" class="form-control d-none">
            </div>

            <!-- Right Column: Edit User Details -->
            <div class="col-md-7"> 
                <div class="mb-3">
                    <label for="name" class="form-label fw-medium">Name</label>
                    <input type="text" class="form-control form-control-lg" name="name" id="name" value="{{ old('name', $user->name) }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fw-medium">Email</label>
                    <input type="email" class="form-control form-control-lg" name="email" id="email" value="{{ old('email', $user->email) }}">
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="city" class="form-label fw-medium">City</label>
                        <input type="text" class="form-control form-control-lg" name="city" id="city" value="{{ old('city', $user->city) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-medium">Phone</label>
                        <input type="tel" class="form-control form-control-lg" name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="notes" class="form-label fw-medium">Notes</label>
                    <textarea class="form-control form-control-lg" name="notes" id="notes" rows="3">{{ old('notes', $user->notes) }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn bg-custom-green text-white px-4 py-2">Save</button>
                </div>
            </div>
        </div>
    </form>

    </main>

    <!-- Footer Placeholder (dari kode Order yang sudah di-Bootstrap-kan) -->
    <footer class="bg-custom-green text-white mt-5 py-5">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                    <div class="d-inline-block mb-2 footer-logo">
                        <img src="{{ asset('img/Logo LastBite.png') }}" alt="LastBite Logo">
                    </div>
                    <p class="h3 font-serif-display mb-3">Thank you for your curiosity.</p>
                    <div class="d-flex justify-content-center justify-content-md-start gap-3 mb-3">
                        <a href="#" class="text-white text-decoration-none">Home</a>
                        <a href="#" class="text-white text-decoration-none">Eatery</a>
                        <a href="#" class="text-white text-decoration-none">Order</a>
                    </div>
                </div>
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
                           <svg class="footer-social-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M2.25 12c0-.69.196-1.342.557-1.904L1.666 3h4.447l1.484 7.063L9.903 3h4.447l2.668 11.393L18.25 3h4.083l-1.484 7.096c.361.562.557 1.213.557 1.904 0 2.062-1.335 3.75-3.002 3.75-1.667 0-3.002-1.688-3.002-3.75 0-.84.28-1.608.75-2.25l-1.42-6.04L12.446 18H9.995L7.91 9.75c.47.642.75 1.41.75 2.25 0 2.062-1.336 3.75-3.002 3.75C4.021 15.75 2.25 14.062 2.25 12Z"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary-subtle my-4 opacity-50">
            <div class="text-center text-md-start">
                <p class="small text-white-50">© 2023 LastBite Inc. All rights reserved</p>
            </div>
            <div class="mt-5 text-center footer-big-logo">
                 <img src="{{ asset('img/Logo LastBite.png') }}" alt="LastBite" class="mx-auto">
            </div>
        </div>
    </footer>
    <script src="{{ asset('bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.getElementById('img_path').addEventListener('change', function (e) {
            const [file] = e.target.files;
            if (file) {
                const img = document.querySelector('.profile-image img');
                img.src = URL.createObjectURL(file);
            }
        });
    </script>

</body>
</html>