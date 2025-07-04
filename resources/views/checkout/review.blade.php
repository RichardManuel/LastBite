@extends('layouts.app')

@section('title', 'Review & Pay - Checkout')

@push('styles')
   <link rel="stylesheet" href="{{ asset('css/review.css') }}">
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

            {{-- Back Link --}}
            <a href="{{ route('checkout.reserved') }}" class="back-link">
                <i class="bi bi-arrow-left-circle ms-4"></i>Back
            </a>

            {{-- Progress Bar --}}
            <div class="checkout-progress-bar">
                <div class="step active">
                    <div class="circle">1</div>
                    <div class="label">Reserved</div>
                </div>
                <div class="step active">
                    <div class="circle">2</div>
                    <div class="label">Review & Pay</div>
                </div>
                <div class="step">
                    <div class="circle">3</div>
                    <div class="label">Confirmation</div>
                </div>
            </div>

            {{-- Display Error Messages --}}
            @if(session('error'))
                <div class="alert alert-danger my-3" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row gx-4 mt-4 mx-5 mb-3">
                {{-- Left Column: Order Summary --}}
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <div class="order-summary-card">
                        <h3>ORDER SUMMARY</h3>

                        <div class="eatery-info">
                            <i class="bi bi-shop"></i>
                            <span>{{ $order->store->store_name}}</span>
                        </div>
                        <div class="item-info">
                            <i class="bi bi-bag-check"></i>
                            <span>{{ $order->order_name }}</span>
                        </div>

                        <hr class="my-3">

                        <div class="summary-item">
                            <span>Subtotal</span>
                            <span>IDR {{ number_format($order->order_price, 2, ',', '.') }}</span>
                        </div>
                        <div class="summary-item">
                            <span>Taxes</span>
                            <span>IDR {{ number_format($summary->taxes ?? 0, 2, ',', '.') }}</span>
                        </div>
                        <div class="summary-item">
                            <span>Application taxes</span>
                            <span>IDR {{ number_format($summary->application_taxes ?? 0, 2, ',', '.') }}</span>
                        </div>
                        <div class="grand-total-item mt-3">
                            <span>Grand Total</span>
                            <span>IDR {{ number_format($summary->grand_total ?? 0, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Payment Method --}}
                <div class="col-lg-5">
                    <div class="payment-card">
                        <h3>Payment Method</h3>
                        <form action="{{ route('checkout.stripe') }}" method="POST" id="payment-form">
                            @csrf
                            {{-- Hidden input (gunakan session atau input sebelumnya jika diperlukan) --}}
                            <input type="hidden" name="customer_id" value="{{ session('checkout_customer_id') }}">
                            <input type="hidden" name="store_id" value="{{ session('checkout_store_id') }}">
                            <input type="hidden" name="pickup_id" value="{{ session('checkout_pickup_id') }}">

                            {{-- Placeholder untuk metode pembayaran --}}
                            <div id="card-element" class="stripe-card-element">
                                <i class="bi bi-credit-card-fill"></i>
                                <span class="fw-bold">Card</span>
                            </div>

                            <div id="card-errors" role="alert" class="text-danger mb-3"></div>

                            <button type="submit" class="btn btn-place-order w-100 mt-3">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
