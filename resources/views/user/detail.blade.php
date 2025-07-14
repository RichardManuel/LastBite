@extends('store.layouts.app')

@section('title', $eatery->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/styledetail.css') }}">
    {{-- Kita mungkin butuh sedikit CSS tambahan untuk status 'active' --}}
    <style>
        .nav-button.active {
            border-color: transparent;
        }
        .nav-button.active .nav-button-main-area {
            background-color: #e0e0e0;
        }
    </style>
@endpush

@section('content')
    {{-- Bagian Header (Kode ini sudah benar dan tetap sama) --}}
    <header>
        <div class="banner-image-container">
            <img src="{{ asset('storage/' . $eatery->picture_of_restaurant) }}" alt="{{$eatery->name}} Banner" class="img-fluid banner-image">
        </div>
        <div class="container-xl restaurant-info-card-container">
            <div class="restaurant-info-card">
                <div class="d-flex align-items-center flex-grow-1">
                    <img src="{{ asset('storage/' . $eatery->picture_of_products) }}" alt="{{$eatery->name}}" class="restaurant-logo me-3">
                    <div class="namecat">
                        <h2>{{$eatery->name}}</h2>
                        <p class="text-muted mb-1">{{$eatery->food_type}}</p>
                    </div>
                </div>
                <div class="rating-badge-custom">
                    <div class="rating-score">{{$eatery->rating}}★</div>
                    <div class="rating-count">{{$eatery->reviews_count}} ratings</div>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation Buttons (diubah menjadi link <a>) -->
    <div class="container my-4">
        <div class="row g-5 nav-buttons-container">
            {{-- Tombol untuk "What you get?" --}}
            <div class="col-md-4">
                <button data-target="panel-what-you-get" class="btn nav-button w-100 active">
                    {{-- ... Konten tombol (icon, teks) ... --}}
                    <div class="nav-button-icon-wrapper" style="background-color: #0069A8;">
                        <i class="fas fa-shopping-bag icon-fa"></i>
                    </div>
                    <div class="nav-button-main-area">
                        <div class="nav-button-text-content">
                            <strong>What you get?</strong><br>
                            <small>Surprised Bag</small>
                        </div>
                        <i class="far fa-question-circle info-icon"></i>
                    </div>
                </button>
            </div>
            {{-- Tombol untuk "Pick up time" --}}
            <div class="col-md-4">
                <button data-target="panel-pickup-time" class="btn nav-button w-100">
                     {{-- ... Konten tombol (icon, teks) ... --}}
                     <div class="nav-button-icon-wrapper" style="background-color: #C70036;">
                        <i class="fas fa-clock icon-fa"></i>
                    </div>
                    <div class="nav-button-main-area">
                        <div class="nav-button-text-content">
                            <strong>Pick up time</strong><br>
                            <small>See policy</small>
                        </div>
                        <i class="far fa-question-circle info-icon"></i>
                    </div>
                </button>
            </div>
            {{-- Tombol untuk "Eatery detail" --}}
            <div class="col-md-4">
                <button data-target="panel-eatery-detail" class="btn nav-button w-100">
                    {{-- ... Konten tombol (icon, teks) ... --}}
                    <div class="nav-button-icon-wrapper" style="background-color: #FFA629;">
                        <i class="fas fa-store icon-fa"></i>
                    </div>
                    <div class="nav-button-main-area">
                        <div class="nav-button-text-content">
                            <strong>Eatery detail</strong><br>
                            <small>Location & info</small>
                        </div>
                       <i class="far fa-question-circle info-icon"></i>
                    </div>
                </button>
            </div>
        </div>
    </div>


    <div class="container-fluid mb-5 px-0">

        {{-- Panel 1: What You Get --}}
        <div id="panel-what-you-get" class="dynamic-panel active">
            <div class="dynamic-panel-container panel-what-you-get">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-5 text-center text-md-start">
                            <img src="{{ asset('images/Surpised-Bag.svg') }}" alt="Surprise Bag" class="img-fluid">
                        </div>
                        <div class="col-md-7">
                            <h3 class="fw-bold display-1">Surprise Bag</h3>
                            <p class="price">Rp {{ number_format($eatery->pricing, 0, ',', '.') }}</p>
                            <p class="description">A Surprise Bag is a mystery bundle of unsold but perfectly good food offered at a much lower price, ideal for food lovers who enjoy surprises and want to fight food waste!</p>
                            <button class="btn order-now-btn">Order Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Panel 2: Pick Up Time --}}
        <div id="panel-pickup-time" class="dynamic-panel">
            <div class="dynamic-panel-container panel-pick-up-time">
                <div class="row align-items-center">
                    <div class="col-md-5 text-center text-md-start">
                        <img src="{{ asset('images/Pick up time.svg') }}" alt="Illustration" class="img-fluid">
                    </div>
                    <div class="col-md-7">
                        <h3>Pick Up Time Policy</h3>
                        <p class="time"><strong class="timeEat">Lunch</strong> 🕛 11:00 PM - 1:00 PM</p>
                        <p class="time"><strong class="timeEat">Dinner</strong> 🕕 6:00 PM - 8:00 PM</p>
                        <div class="note mt-3">
                            <p class="mb-0"><strong class="text-warning">⚠️ Please Note:</strong></p>
                            <p class="mb-0">Orders must be picked up on time. Missed orders will be canceled automatically with no refund.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Panel 3: Eatery Detail --}}
        <div id="panel-eatery-detail" class="dynamic-panel">
            <div class="dynamic-panel-container panel-eatery-detail">
                <h3 class="panel-main-title text-center">Eatery Detail</h3>
                <div class="row mt-2 align-items-start">
                    <div class="col-lg-8 col-md-7 mb-4 mb-md-0">
                        <div class="d-flex align-items-start">
                            <img src="{{ asset('storage/' . $eatery->picture_of_products) }}" alt="{{ $eatery->name }} Logo" class="eatery-logo-main">
                            <div class="eatery-text-details">
                                <h4 class="eatery-name">{{ $eatery->name }}</h4>
                                <p class="eatery-address mb-3">{{ $eatery->location }}</p>
                                <p class="eatery-hours-title mb-1"><strong>Hours Of Operation</strong></p>
                                <p class="eatery-hours-time mb-3">{{ $eatery->operational_time }}</p>
                                <p class="eatery-phone">
                                    <i class="fas fa-phone-alt me-2"></i>{{ $eatery->telephone }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-5">
                        <div class="map-placeholder">
                        <iframe src="https://maps.google.com/maps?q={{ urlencode($eatery->location) }}&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const navButtons = document.querySelectorAll('.nav-button');
        const dynamicPanels = document.querySelectorAll('.dynamic-panel');

        navButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Hapus kelas 'active' dari semua tombol dan panel
                navButtons.forEach(btn => btn.classList.remove('active'));
                dynamicPanels.forEach(panel => panel.classList.remove('active'));

                // Tambahkan kelas 'active' ke tombol yang diklik
                this.classList.add('active');

                // Dapatkan target panel dari atribut data-target
                const targetPanelId = this.dataset.target;
                const targetPanel = document.getElementById(targetPanelId);

                // Tampilkan panel yang sesuai
                if (targetPanel) {
                    targetPanel.classList.add('active');
                }
            });
        });
    });
</script>
@endpush
