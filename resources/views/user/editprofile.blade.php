@extends('user.layouts.app')

{{-- Anda bisa menambahkan CSS khusus untuk homepage di sini jika perlu --}}
@push('styles')
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            background-color: #ffffffff;
            /* custom-beige */
            color: #374151;
            /* custom-dark-text */
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
            background-color: #FACC15 !important;
            /* yellow-400 equivalent */
            color: #1f2937 !important;
            /* Contoh warna teks gelap untuk kontras */
        }

        .bg-custom-yellow-button:hover {
            background-color: #FBBF24 !important;
            /* yellow-500 equivalent */
        }

        .text-custom-light-text {
            color: #6B7280 !important;
        }

        .text-custom-dark-text {
            color: #374151 !important;
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
            background-color: #E9ECEF;
            /* Warna abu-abu muda seperti di gambar */
            border: 1px solid #CED4DA;
            /* Border standar Bootstrap */
        }

        .form-control:focus {
            background-color: #E9ECEF;
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, .25);
        }
    </style>
@endpush

@section('content')

    <body class="bg-custom-beige text-custom-dark-text">
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
                            @if ($user->img_path)
                                <img src="{{ asset('storage/uploads/' . $user->img_path) }}" alt="User Profile Image"
                                    class="rounded w-100 h-100 object-fit-cover border border-4 border-custom-green shadow-lg">
                            @else
                                <img src="{{ asset('img/defaultprofile.jpg') }}" alt="Default Profile Image"
                                    class="rounded w-100 h-100 object-fit-cover border border-4 border-custom-green shadow-lg">
                            @endif
                        </div>

                        <!-- Custom styled label that acts as upload button -->
                        <label
                            class="btn bg-custom-yellow-button text-dark px-3 py-2 rounded-md small fw-medium d-flex align-items-center"
                            for="img_path">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-image me-2" viewBox="0 0 16 16">
                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                <path
                                    d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12z" />
                            </svg>
                            <span>Change Profile Image</span>
                        </label>
                        <input type="file" name="img_path" id="img_path" class="form-control d-none">
                    </div>

                    <!-- Right Column: Edit User Details -->
                    <div class="col-md-7">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-medium">Name</label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name"
                                value="{{ old('name', $user->name) }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-medium">Email</label>
                            <input type="email" class="form-control form-control-lg" name="email" id="email"
                                value="{{ old('email', $user->email) }}">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="city" class="form-label fw-medium">City</label>
                                <input type="text" class="form-control form-control-lg" name="city" id="city"
                                    value="{{ old('city', $user->city) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-medium">Phone</label>
                                <input type="tel" class="form-control form-control-lg" name="phone" id="phone"
                                    value="{{ old('phone', $user->phone) }}">
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
        <script src="{{ asset('bootstrap-5.3.6-dist/js/bootstrap.bundle.min.js') }}"></script>
        <script>
            document.getElementById('img_path').addEventListener('change', function(e) {
                const [file] = e.target.files;
                if (file) {
                    const img = document.querySelector('.profile-image img');
                    img.src = URL.createObjectURL(file);
                }
            });
        </script>

    </body>

@endsection
