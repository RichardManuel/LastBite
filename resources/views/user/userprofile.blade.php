@extends('user.layouts.app')

@section('title', 'Welcome to LastBite - Save Food, Save Money')

{{-- Anda bisa menambahkan CSS khusus untuk homepage di sini jika perlu --}}
@push('styles')
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            background-color: #FBF5EC;
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
            /* w-48 */
            height: 12rem;
            /* h-48 */
        }

        @media (min-width: 768px) {

            /* md breakpoint */
            .profile-image {
                width: 14rem;
                /* md:w-56 */
                height: 14rem;
                /* md:h-56 */
            }
        }

        .hr-profile {
            border-top: 1px solid #D1D5DB;
            /* border-gray-300 */
            /* Untuk membuat garis lebih pendek dan menyisakan ruang untuk ikon pensil */
            width: calc(100% - 3rem);
            /* Sesuaikan 3rem ini jika perlu */
        }
    </style>
@endpush

@section('content')

    <body class="bg-custom-beige text-custom-dark-text">

        <!-- Main Content -->
        <main class="container mt-4 mb-4 py-md-5 px-4">

            <div class="mb-4 mb-md-5">
                <h1 class="display-5 display-md-4 font-serif-display text-dark text-md">Profile.</h1>
                <h3 class="text-secondary fw-normal fs-6 text-md-start">Manage Your Account and Preferences</h3>
            </div>

            <div class="row g-md-3 g-2">

                <!-- Left Column: Profile Image -->
                <div class="col-md-3 d-flex flex-column align-items-center align-items-md-start">
                    <div class="position-relative mb-3 profile-image">
                        @if ($user->img_path)
                            <img src="{{ asset('storage/uploads/' . $user->img_path) }}?v={{ $user->updated_at->timestamp }}"
                                alt="User Profile Image"
                                class="rounded w-100 h-100 object-fit-cover border border-4 border-custom-green shadow-lg">
                        @else
                            <img src="{{ asset('img/defaultprofile.jpg') }}" alt="Default Profile Image"
                                class="rounded w-100 h-100 object-fit-cover border border-4 border-custom-green shadow-lg">
                        @endif

                    </div>
                </div>

                <!-- Right Column: User Details -->
                <div class="col-md-7">
                    <div class="mb-4">
                        <h2 class="h2 font-serif-display text-dark mb-1">{{ $user->name }}</h2>
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="text-secondary fst-italic small">{{ $user->notes }}</p>
                            <button class="btn btn-sm bg-custom-yellow-button rounded-md ms-3 flex-shrink-0 p-2"
                                aria-label="Edit bio" onclick="window.location.href='{{ route('profile.edit') }}'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pencil-fill text-dark" viewBox="0 0 16 16">
                                    <path
                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                </svg>
                            </button>
                        </div>
                        <hr class="my-3  border-dark">
                    </div>

                    <div class="vstack gap-2">
                        <div class="row">
                            <span class="col-3 col-md-2 fw-medium text-secondary">Email</span>
                            <span class="col-9 col-md-10 fw-semibold text-custom-dark-text">{{ $user->email }}</span>
                        </div>
                        <div class="row">
                            <span class="col-3 col-md-2 fw-medium text-secondary">City</span>
                            <span class="col-9 col-md-10 fw-semibold text-custom-dark-text">{{ $user->city }}</span>
                        </div>
                        <div class="row">
                            <span class="col-3 col-md-2 fw-medium text-secondary">Phone</span>
                            <span class="col-9 col-md-10 fw-semibold text-custom-dark-text">{{ $user->phone }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
@endsection
