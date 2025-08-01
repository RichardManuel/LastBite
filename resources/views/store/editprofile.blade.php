@extends('store.layouts.app')

@section('title', 'Edit Restaurant Profile')

@push('styles')
<style>
    :root {
        --brand-yellow-navbar: #F5C563;
        --brand-orange-accent: #F9A826;
        --brand-text-dark: #3A2E39;
        --brand-text-light: #584957;
    }

    body {
        font-family: 'Instrument Serif', serif;
        background-color: #fff;
        color: var(--brand-text-dark);
    }

    h1 {
        font-family: 'Instrument Serif', serif;
        font-size: 3rem;
    }

    form-label {
        font-family: 'Instrument Serif', serif;
        color: var(--brand-text-dark);
    }

    .form-control {
        font-family: 'Instrument Sans', sans-serif !important;
        color: var(--brand-text-dark);
    }

    .form-section {
        padding: 3rem 1rem;
    }

    .restaurant-photo-preview {
        max-height: 250px;
        object-fit: cover;
        width: 100%;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .btn-warning {
        background-color: #F3C148;
        border: none;
        font-family: 'Instrument Sans', sans-serif;
    }

    .btn-warning:hover {
        background-color: #e0931f;
    }
</style>
@endpush

@section('content')
<div class="container form-section">
    <h1 class="text-center mb-5">Edit Restaurant Profile</h1>

    <form action="{{ route('resto.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-5">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <label class="form-label">Restaurant Photos</label>
                @if($restaurant->restaurant_picture_path)
                    <img src="{{ asset('storage/' . $restaurant->restaurant_picture_path) }}" class="restaurant-photo-preview" alt="Restaurant Photo">
                @endif
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

            <!-- Kolom Kanan -->
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
@endsection
