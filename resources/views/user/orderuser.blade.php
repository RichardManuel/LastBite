@extends('user.layouts.app')

@section('title', 'Order - LastBite')

@push('styles')
    <style>
        body {
            background-color: #FBF5EC;
        }
        .bg-custom-light-green-card {
            background-color: #F3F8F3;
        }
        .border-custom-green-border {
            border-color: #4CAF50 !important;
        }
        .text-custom-light-text {
            color: #888;
        }
        .text-custom-dark-text {
            color: #222;
        }
        .bg-custom-green {
            background-color: #4CAF50;
        }
        .order-card {
            border-radius: 1rem;
        }
    </style>
@endpush

@section('content')
<main class="container mt-4 mb-4 mt-md-5 mb-md-5 px-4">

    <div class="mb-4 mb-md-5">
        <h1 class="display-4 font-serif-display text-dark" style="font-family: Instrument Serif, serif; font-size: 70px;">Order.</h1>
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
        @forelse($orders as $order)
            <div class="bg-custom-light-green-card border border-custom-green-border p-3 p-md-4 shadow-sm order-card mb-3">
                <div class="row g-3">
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Order ID</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">#{{ $order->order_id }}</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Restaurant</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">{{ $order->restaurant->name ?? '-' }}</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Payment</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">{{ $order->payment_method }}</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Status</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">{{ $order->status }}</p>
                    </div>
                    <div class="col-6 col-sm-4 col-md">
                        <p class="text-xs text-custom-light-text">Total</p>
                        <p class="text-base fw-semibold text-custom-dark-text mt-1">Rp {{ number_format($order->item_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-custom-light-text py-5">
                Belum ada order.
            </div>
        @endforelse
    </div>
</main>
@endsection