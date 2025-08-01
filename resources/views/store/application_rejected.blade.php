@extends('store.layouts.app')

@section('title', 'Pending_Profile')

@push('styles')
    <style>
        :root {
            --brand-yellow-navbar: #F5C563;
            --brand-orange-accent: #F9A826;
            --brand-text-dark: #3A2E39;
            --brand-text-light: #584957;
            --profile-bg: #FAF7F2;
            /* Warna background area profil seperti di gambar */
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
            flex-direction: column;
            color: var(--brand-text-dark);
        }

        main {
            display: block;
            unicode-bidi: isolate;
            margin-bottom: 5rem;
            margin-top: 5rem;
            justify-content: center;
        }
    </style>
@endpush

@section('content')
    <!-- Main Content for Restaurant Profile Display -->
    <div class="container text-center mt-5">
        <h1>Application Rejected</h1>
        <p class="lead">Unfortunately, your application was not approved by our admin team.</p>
        <p>If you believe this is a mistake, please contact our support.</p>    
    </div>
@endsection
