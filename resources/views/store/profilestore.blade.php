@extends('store.layouts.app')

@section('title', $restaurant->name ?? 'Restaurant Profile')

@push('styles')
<style>
    :root {
        --brand-yellow-navbar: #F5C563;
        --brand-orange-accent: #F9A826;
        --brand-text-dark: #3A2E39;
        --brand-text-light: #584957;
        --profile-bg: #FAF7F2;
        --profile-border: #EAE0CC;
        --rating-bg: #FFF7E6;
        --rating-border: #FFECCF;
        --rating-star: #FFC107;
        --font-serif-display: 'Playfair Display', serif;
        --font-sans-body: 'Roboto', sans-serif;
        --footer-bg: #F5C563;
        --footer-text: #3A2E39;
    }

    body {
        font-family: 'Instrument Serif', serif;
        background-color: #FFFFFF;
        color: var(--brand-text-dark);
    }

    .profile-banner {
        height: 300px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .profile-banner::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(0,0,0,0.1);
    }

    .profile-details-card {
        background-color: var(--profile-bg);
        border: 1px solid var(--profile-border);
        border-radius: 12px;
        padding: 2rem;
        margin-top: -80px;
        position: relative;
        z-index: 10;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    .profile-details-card h1 {
        font-family: var(--font-serif-display);
        color: var(--brand-text-dark);
        font-size: 2.2rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem 2rem;
        margin-bottom: 1.5rem;
    }

    .info-item {
        text-align: left;
    }
    .info-item .info-label {
        font-size: 0.8rem;
        color: var(--brand-text-light);
        margin-bottom: 0.2rem;
        display: block;
        font-weight: 500;
        text-transform: uppercase;
    }
    .info-item .info-value {
        font-size: 0.95rem;
        color: var(--brand-text-dark);
        font-weight: 500;
    }
    .info-item .info-value.description {
        font-size: 0.9rem;
        line-height: 1.6;
        color: var(--brand-text-light);
        font-weight: 400;
    }

    .rating-badge {
        background-color: var(--rating-bg);
        border: 1px solid var(--rating-border);
        color: var(--brand-text-dark);
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-block;
    }
    .rating-badge .bi-star-fill {
        color: var(--rating-star);
        margin-right: 0.2rem;
        font-size: 0.8rem;
    }
    .rating-count {
        font-size: 0.75rem;
        color: var(--brand-text-light);
        display: block;
        margin-top: 0.2rem;
    }

    .btn-edit-custom {
        background-color: var(--brand-orange-accent);
        color: white;
        font-weight: 500;
        padding: 0.5rem 1.2rem;
        border-radius: 0.25rem;
        font-size: 0.9rem;
        border: none;
        text-decoration: none;
    }
    .btn-edit-custom:hover {
        background-color: #e0931f;
        color: white;
    }
</style>
@endpush

@section('content')
<main class="main-content mb-5">
    @if(isset($restaurant))
        <div class="profile-banner" style="background-image: url('{{ asset('storage/' . $restaurant->restaurant_picture_path) }}');"></div>

        <div class="container">
            <div class="profile-details-card">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h1>Restaurant Profile</h1>
                    <div class="text-end">
                        <span class="rating-badge"><i class="bi bi-star-fill"></i> 4.6</span>
                        <span class="rating-count">300+ ratings</span>
                    </div>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Application ID</span>
                        <span class="info-value">#{{ $restaurant->application_id_display ?? $restaurant->restaurant_id ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Restaurant</span>
                        <span class="info-value">{{ $restaurant->name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Location</span>
                        <span class="info-value">{{ $restaurant->location ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Applicant Name</span>
                        <span class="info-value">{{ $restaurant->applicant_name ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $restaurant->email ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Telephone</span>
                        <span class="info-value">{{ $restaurant->telephone ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Operational time</span>
                        <span class="info-value">{{ $restaurant->operational_hours ?? 'N/A' }}</span>
                    </div>
                </div>

                <div class="info-item mb-3">
                    <span class="info-label">Description</span>
                    <p class="info-value description">{{ $restaurant->description ?? 'No description provided.' }}</p>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Type of food sold</span>
                        <span class="info-value">{{ $restaurant->food_type ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Pricing</span>
                        <span class="info-value">{{ $restaurant->pricing_tier ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Best Before</span>
                        <span class="info-value">{{ $restaurant->best_before ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Bank Account</span>
                        <span class="info-value">{{ $restaurant->account_bank ?? 'N/A' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Account Name</span>
                        <span class="info-value">{{ $restaurant->bank_account_name ?? 'N/A' }}</span>
                    </div>
                </div>

                <div class="text-end mt-4">
                    @if(Auth::guard('resto')->check())
                        <a href="{{ route('resto.profile.edit') }}" class="btn btn-edit-custom">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="container text-center py-5">
            <p>Restaurant profile not found or you are not authorized to view this page.</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Go to Homepage</a>
        </div>
    @endif
</main>
@endsection
