{{-- resources/views/checkout/reserved.blade.php --}}
@extends('layouts.app')

@section('title', 'Reserved - Checkout')

@push('styles')
   <link rel="stylesheet" href="{{ asset('css/reserved.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="checkout-container">

        {{-- Checkout Title --}}
        <div class="checkout-title-container">
            <hr>
            <span class="checkout-title-text">Checkout</span>
            <hr>
        </div>

        {{-- Progress Bar --}}
        <div class="checkout-progress-bar">
            <div class="step active">
                <div class="circle">1</div>
                <div class="label">Reserved</div>
            </div>
            <div class="step">
                <div class="circle">2</div>
                <div class="label">Review & Pay</div>
            </div>
            <div class="step">
                <div class="circle">3</div>
                <div class="label">Confirmation</div>
            </div>
        </div>

        {{-- Error Message --}}
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <h2 class="reserved-info-title">Reserved Information</h2>

        {{-- Form --}}
        <form action="{{ route('checkout.processReservedInfo') }}" method="POST">
            @csrf
            <input type="hidden" name="customer_name" value="{{ $customer->customer_name }}">

            <div class="row gx-4"> 
                {{-- Left Column: Eatery Info --}}
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="eatery-detail-card">
                        <div class="eatery-detail">
                            <h3>Eatery Detail</h3>
                            <h4>{{ $store->store_name }}</h4>
                            <p>{{ $store->store_address }}</p>
                            <div class="pick-up-time">
                                <strong>Pick up time</strong>
                                <p>{{ $pickup->time_type }} : {{ \Carbon\Carbon::parse($pickup->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($pickup->end_time)->format('g:i A') }}</p>
                            </div>
                            <div class="phone-info">
                                <i class="bi bi-telephone-fill"></i>
                                <span>{{ $store->store_phone }}</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="https://www.google.com/maps?q={{ urlencode($store->store_address) }}" target="_blank" class="btn btn-show-location w-auto mt-5">Show Location</a>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Customer Info --}}
                <div class="col-lg-5"> 
                    <div class="user-info-section">
                        <h3>{{ $customer->customer_name }}</h3>

                        <div class="info-item">
                            <strong>Email</strong>
                            <span>{{ $customer->customer_email }}</span>
                        </div>

                        <div class="info-item">
                            <strong>City</strong>
                            <span>{{ $customer->customer_city }}</span>
                        </div>

                        <div class="info-item">
                            <strong>Phone</strong>
                            <span>{{ $customer->customer_phone }}</span>
                        </div>

                        {{-- Pickup Time --}}
                        <div class="info-item">
                            <strong class="custom-text d-block mb-2">Select pick up time</strong>
                            <div class="d-flex gap-2">
                                <input type="radio" class="btn-check" name="pickup_time" id="lunch" value="1" checked>
                                <label class="btn btn-pickup" for="lunch">Lunch</label>

                                <input type="radio" class="btn-check" name="pickup_time" id="dinner" value="2">
                                <label class="btn btn-pickup" for="dinner">Dinner</label>
                            </div>
                        </div>

                        {{-- Notes --}}
                        <div class="form-group mt-3">
                            <label for="notes" class="form-label" style="color: var(--primary-green); font-weight: bold;">Notes</label>
                            <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Add any notes here..."></textarea>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" class="btn btn-confirm w-100 mt-4">Review Your Order</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
