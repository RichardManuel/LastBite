@extends('layouts.app')

@section('title', 'Welcome to LastBite - Save Food, Save Money')

{{-- Anda bisa menambahkan CSS khusus untuk homepage di sini jika perlu --}}
@push('styles')
<style>
    .hero-home {
        height: 100vh; /* Membuat hero section setinggi layar */
        background-size: cover;
        background-position: center;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
    }
    .hero-home::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
    }
    .hero-home .content {
        position: absolute; /* Agar di atas overlay */
        z-index: 2;
    }
    .section-how-to .step-image {
        max-width: 100%;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .section-intro {
        /* Hapus padding vertikal bawaan dari .py-5 jika ada */
        padding-top: 0;
        padding-bottom: 0;
        background-color: #327959; /* Warna hijau Anda */
        color: white;
        overflow: hidden; /* Mencegah elemen keluar dari batas secara aneh */
    }

    /* Pembungkus gambar, ini adalah dasar untuk positioning */
    .introducing-image-wrapper {
        position: relative;
        text-align: center; /* Untuk menengahkan logo overlay */
    }

    /* Gambar latar belakang utama */
    .introducing-image-bg {
        /* Pastikan gambar mengisi seluruh tinggi kolomnya */
        height: 100%;
        width: 100%;
        object-fit: cover; /* Agar gambar tidak gepeng */
    }

    /* Logo yang menimpa gambar */
    .introducing-logo-overlay {
        position: absolute;   /* Mengambang di atas parent (.introducing-image-wrapper) */
        top: 50%;             /* Posisikan 50% dari atas */
        left: 50%;            /* Posisikan 50% dari kiri */
        transform: translate(-50%, -50%); /* Trik untuk menengahkan elemen secara presisi */
        
        max-width: 50%; /* Batasi lebar logo agar tidak terlalu besar */
        height: auto;
    }

    /* Pembungkus teks di kolom kanan */
    .introducing-text-content {
        padding: 4rem; /* Beri padding agar teks tidak menempel di tepi */
    }

    .text-brand-orange {
        color: #FDA402 !important; /* Warna kuning/oranye brand Anda */
    }

    /* Penyesuaian untuk layar kecil (mobile) */
    @media (max-width: 991.98px) {
        /* Di mobile, gambar dan teks akan bertumpuk vertikal */
        .introducing-text-content {
            padding: 2rem;
            text-align: center;
        }
        .introducing-image-wrapper {
            /* Kita mungkin ingin menyembunyikan logo overlay di mobile jika terlalu ramai */
             /* .introducing-logo-overlay { display: none; } */
        }
    }

    .py-5 .container footer{
        font-family: 'Instrument Serif', serif;
        font-size: 25px;
    }

    .content h1{
        padding-top: 200px;
        font-size: 100px;
    }
    .mt-5{
        padding-top: 120px;
        /* margin-bottom: -100px; */
    }

    .lastbite{
        font-family: 'Instrument Serif', serif;
        font-size: 90px;
        color: #FDA402;
        padding-left: 15px;
    }

    .py-5 .container p{
        font-size: 18px;
    }

    .kiri h3{
        font-size: 35px;
        color: #1F744E;
        font-family: 'Instrument Serif', serif; 
    }

    .kanan h3{
        font-size: 35px;
        color: #FDA402;
        font-family: 'Instrument Serif', serif;
    }

    .container{
        text-align: center;
    }

     .steps-wrapper {
        max-width: 1100px; /* Tentukan lebar maksimal untuk konten step */
        margin-left: 150px;
        margin-right: auto; /* Ini akan membuatnya menjadi tengah */
    }

    /* Pastikan teks di dalam kolom tetap rata kiri */
    .steps-wrapper .col-md-6 {
        text-align: left;
    }

    .container .col-md-6{
        text-align: left;
    }

    .navbar-transparent {
        position: absolute; /* Membuat navbar mengambang */
        width: 100%;      /* Pastikan lebarnya penuh */
        top: 0;           /* Tempelkan di paling atas */
        left: 0;
        z-index: 10;      /* Pastikan di atas elemen lain */
        
        /* Gradient (sudah benar) */
        background: linear-gradient(to bottom, rgba(0,0,0,0.65) 0%, rgba(0,0,0,0) 100%);
        box-shadow: none !important;
    }

    .quote-section { /* Beri kelas ini ke <section> quote Anda */
        padding-top: 100px; /* Sesuaikan nilainya dengan tinggi navbar Anda */
    }

    .introducing-image{
        width: 630px;
        height: auto;
    }

    .step-desc{
        margin-bottom: -1px;
        font-size: 10px;
        font-weight: bold;
    }

    p.lead strong,
    p.lead b {
        font-weight: 700 !important; /* atau 'bolder' */
    }

    .blockquote-footer::before {
        content: "" !important; /* Kosongkan kontennya */
    }

    .blockquote-footer{
        padding-top: 8px;
    }

</style>
@endpush

@section('content')

    <!-- Hero Section -->
    <section class="hero-home" style="background-image: url('{{ asset('images/hero-bg.svg') }}');">
        <div class="content">
            <h1 class="display-1 fw-normal" style="font-family: 'Instrument Serif', serif;">Save the Best for <br>the Last.</h1>
            <p class="lead col-md-8 mx-auto mt-4">
                Just because it's leftover doesn't mean it's left behind. These meals are still full of flavor, perfectly safe to eat, and ready for their second moment to shine. Don't toss it — taste it, enjoy it, and help reduce food waste while you're at it.
            </p>
            <div class="mt-5">
                <small>scroll for more</small>
                <div>↓</div>
            </div>
        </div>
    </section>

    <!-- Quote Section -->
    <section class="py-5  text-center quote-section">
        <div class="container">
            <blockquote class="blockquote col-md-8 mx-auto">
                <p class="mb-3">"Every leftover tells a story of effort, flavor, and care. Don't let it end in the trash — give it the spotlight it deserves. After all, some of the best bites happen when we give food a second chance."</p>
                <footer class="blockquote-footer text-success fw-normal">- LastBite -</footer>
            </blockquote>
        </div>
    </section>

    <!-- How To Section -->
    <section class="py-5 section-how-to">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">How to use </h2>
                <h1 class="fw-normal lastbite">LastBite.</h1>
                <p class="lead col-md-8 mx-auto mt-2 ">A Simple Step-by-Step Guide to Reserving Your Surprise Bag</p>
            </div>

            <div class="steps-wrapper">
                {{-- Step 1 --}}
                <div class="row align-items-center mb-5">
                    <div class="col-md-6 kiri">
                        <h3 class="fw-normal">Step 1: Browse the Eatery Page</h3>
                        <p class="step-desc">Find restaurants with food offers that match your schedule.</p>
                        <ul class="list-unstyled lh-lg">
                            <li>• Use filters like Pick up: Lunch or Pick up: Dinner</li>
                            <li>• Click on a restaurant to explore their offers</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('images/step1.png') }}" alt="Browse Eatery Page" class="step-image">
                    </div>
                </div>

                {{-- Step 2 --}}
                <div class="row align-items-center mb-5 flex-row-reverse">
                    <div class="col-md-6 kanan">
                        <h3 class="fw-normal">Step 2: Go to the Eatery Detail Page</h3>
                        <p class="step-desc">Learn more about the restaurant and what they offer.</p>
                        <ul class="list-unstyled lh-lg">
                            <li>• View details of the Surprise Bag</li>
                            <li>• Click "Order Now" to proceed</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('images/step2.png') }}" alt="Eatery Detail Page" class="step-image">
                    </div>
                </div>

            
                <div class="row align-items-center mb-5">
                    <div class="col-md-6 kiri">
                        <h3 class="fw-normal">Step 3: Checkout - Reserved</h3>
                        <p class="step-desc">Confirm your reservation details.</p>
                        <ul class="list-unstyled lh-lg">
                            <li>• Review your info and pickup schedule</li>
                            <li>• Click "Confirm" to continue</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('images/step3.png') }}" alt="Browse Eatery Page" class="step-image">
                    </div>
                </div>

                <div class="row align-items-center mb-5 flex-row-reverse">
                    <div class="col-md-6 kanan">
                        <h3 class="fw-normal">Step 4: Checkout - Review & Pay</h3>
                        <p class="step-desc">Review your full order and make a payment.</p>
                        <ul class="list-unstyled lh-lg">
                            <li>• Check order summary and total cost</li>
                            <li>• Choose your payment method</li>
                            <li>• Click "Place Order" to finish</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('images/step4.png') }}" alt="Eatery Detail Page" class="step-image">
                    </div>
                </div>
                
                <div class="row align-items-center mb-5">
                    <div class="col-md-6 kiri">
                        <h3 class="fw-normal">Step 5: Checkout - Confirmation</h3>
                        <p class="step-desc">Your Surprise Bag is officially booked!</p>
                        <ul class="list-unstyled lh-lg">
                            <li>• See your order number and pickup info</li>
                            <li>• Click "Done" to return or view your order</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('images/step5.png') }}" alt="Browse Eatery Page" class="step-image">
                    </div>
                </div>
            </div>

        </div>
    </section>
    
    <!-- Introducing Section -->
    <section class="section-intro">
        {{-- Kita tidak menggunakan .container di sini agar bisa full-width --}}
        <div class="row g-0 align-items-center"> {{-- g-0 untuk menghapus gutter/spasi antar kolom --}}
            
            {{-- Kolom Kiri untuk Gambar (50% dari lebar) --}}
            <div class="col-lg-6">
                <div class="introducing-image-wrapper"> {{-- Pembungkus baru untuk positioning --}}
                    <img src="{{ asset('images/introduceback.png') }}" alt="A delicious pastry" class="img-fluid introducing-image-bg">
                    
                    {{-- Logo yang menimpa (akan kita atur di CSS) --}}
                    <img src="{{ asset('images/LogoLastBite.png') }}" alt="LastBite Logo" class="introducing-logo-overlay">
                </div>
            </div>

            {{-- Kolom Kanan untuk Teks (50% dari lebar) --}}
            <div class="col-lg-6">
                <div class="introducing-text-content"> {{-- Pembungkus baru untuk padding --}}
                    <h2 class="fw-bold text-brand-orange display-4">Introducing</h2>
                    <h1 class="display-2 fw-normal" style="font-family: 'Instrument Serif', serif; margin-top: -1.5rem;">LastBite.</h1>
                    <p class="lead mt-3">
                        <b>LastBite</b> is an app that lets you rescue leftover food from restaurants and enjoy perfectly good meals at affordable prices. On LastBite, you can buy the best unsold dishes from restaurants at the end of the day — delicious, safe, and budget-friendly.
                    </p>
                </div>
            </div>
            
        </div>
    </section>
@endsection