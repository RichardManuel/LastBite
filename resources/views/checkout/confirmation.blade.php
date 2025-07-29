@extends('user.layouts.app')

@section('title', 'Order Confirmation - Last Bite')

@push('styles')
   <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endpush

@section('content')
    
         <div class="checkout-container">
            {{-- Checkout Title --}}
            <div class="checkout-title-container">
                <hr>
                <span class="checkout-title-text">Checkout</span>
                <hr>
            </div>

            {{-- Progress Bar (Step 1 Aktif) --}}
            <div class="checkout-progress-bar"> {{-- Hapus kelas stepX-completed jika ini step pertama --}}
                <div class="step active">
                    <div class="circle">1</div>
                    <div class="label">Reserved</div>
                </div>
                <div class="step active">
                    <div class="circle">2</div>
                    <div class="label">Review & Pay</div>
                </div>
                <div class="step active">
                    <div class="circle">3</div>
                    <div class="label">Confirmation</div>
                </div>
            </div>

            <div class="confirmation-content mt-4">
                <i class="bi bi-check-circle icon-check"></i>
                <h2>Your Last Bite is booked</h2>
                <p class="subtitle">Let's give perfectly good food the second chance it truly deserves!</p>
                <hr>

                <div class="order-details-item">
                    <i class="bi bi-grid-3x3-gap"></i>
                    <span class="order-id-text">{{ $order_id }}</span>
                </div>
                <div class="order-details-item">
                    <i class="bi bi-shop"></i>
                    <span class="eatery-name-text">{{ $store->store_name }}</span>
                </div>
                <div class="order-details-item">
                    <i class="bi bi-clock-history"></i> {{-- Atau bi-bag --}}
                    <span class="item-name-text">{{ $pickup_time }}</span>
                </div>

                {{-- Link untuk melihat detail pesanan (sesuaikan href jika diperlukan) --}}
                @if(isset($order_id) && $order_id !== 'N/A' && $order_id !== 'DUMMY_'.substr($order_id, -5))
                    <a href="{{ url('/my-orders/' . $order_id) }}" class="see-order-link">
                        <i class="bi bi-arrow-right"></i>
                        Press to see order
                    </a>
                @else
                    {{-- Tampilkan sesuatu yang lain jika order_id tidak valid untuk link --}}
                    <div class="see-order-link" style="color: #6c757d; cursor: default;">
                        <span>Order details sent to your email.</span>
                    </div>
                @endif


                {{-- Tombol Done (sesuaikan href) --}}
                <a href="{{ url('/') }}" role="button" class="btn btn-done">Done</a>
            </div>
        </div>
    </div>
@endsection