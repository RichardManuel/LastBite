@extends('admin.layouts.app')

@section('title', 'Restaurant Management')

@push('styles')
<style>
    /* Tambahan CSS untuk badge Suspended */
    .management-card {
        position: relative; /* Penting untuk penempatan badge secara absolut */
    }

    .suspended-badge {
        position: absolute;
        top: 15px; /* Sesuaikan posisi vertikal */
        right: 15px; /* Sesuaikan posisi horizontal */
        background-color: #dc3545; /* Latar belakang merah untuk status suspended */
        color: white; /* Tulisan diubah kembali ke warna putih agar mudah dibaca */
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 700;
        z-index: 10; /* Pastikan badge berada di atas elemen lain */
        font-family: 'Instrument Sans', sans-serif;
    }

    /* Gaya tambahan dari kode aslinya */
    .main-title {
        font-family: 'Instrument Serif', serif;
        font-size: 3.5rem;
        font-weight: 700;
        color: #474747;
    }

    .sub-title {
        font-family: 'Instrument Sans', sans-serif;
        font-size: 1.2rem;
        color: #7a7a7a;
    }

    .line {
        border: 0;
        height: 1px;
        background: #e0e0e0;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }

    .management-card {
        background-color: #f7f7f7;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .management-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
    
    .detail-label, .detail-value {
        font-family: 'Instrument Sans', sans-serif;
    }
    
    .detail-label {
        font-size: 0.9rem;
        color: #7a7a7a;
        margin-bottom: 0;
    }
    
    .detail-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #474747;
    }
    
    .btn-manage {
        background-color: #ffc107;
        color: #474747;
        font-weight: 600;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        font-family: 'Instrument Sans', sans-serif;
    }
    
    .btn-manage:hover {
        background-color: #e0b000;
        color: #474747;
    }
    
    .actions-dropdown {
        display: none;
        padding: 15px;
        background-color: #f0f0f0;
        border-radius: 10px;
        margin-top: 15px !important;
        border: 1px solid #e0e0e0;
    }
    
    .btn-action {
        font-weight: 600;
        font-family: 'Instrument Sans', sans-serif;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #474747;
        border: none;
        transition: background-color 0.3s ease;
    }
    
    .btn-warning:hover {
        background-color: #e0b000;
        color: #474747;
    }
    
    .btn-success {
        background-color: #28a745;
        color: white;
        border: none;
    }
    
    .btn-close-actions {
        background-color: #6c757d;
        color: white;
        border: none;
        transition: background-color 0.3s ease;
    }
    
    .btn-close-actions:hover {
        background-color: #5a6268;
    }
    
    .contact-modal-content {
        background-color: #f7f7f7;
        border-radius: 15px;
        font-family: 'Instrument Sans', sans-serif;
    }

    .contact-modal-header {
        background-color: #474747;
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .contact-modal-body {
        padding: 20px;
    }
    
    .contact-label {
        font-size: 0.9rem;
        color: #7a7a7a;
        margin-bottom: 0;
    }
    
    .contact-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #474747;
    }
    
</style>
@endpush

@section('content')
<div class="container mt-4">
    <h1 class="main-title">Resto Management</h1>
    <p class="sub-title">Please check the following restaurant ratings</p>
    <hr class="line">

    {{-- LIST RESTO --}}
    @foreach($restaurants as $restaurant)
        <div class="management-card" data-id="{{ $restaurant->restaurant_id }}">
            {{-- Badge Suspended --}}
            @if ($restaurant->status === 'suspended')
                <span class="suspended-badge">Suspended</span>
            @endif

            <div class="row align-items-center summary-row">
                <div class="col-md-2 col-6 mb-2 mb-md-0">
                    <p class="detail-label">Restaurant ID</p>
                    <p class="detail-value">#{{ $restaurant->restaurant_id }}</p>
                </div>
                <div class="col-md-3 col-6 mb-2 mb-md-0">
                    <p class="detail-label">Restaurant</p>
                    <p class="detail-value">{{ $restaurant->name }}</p>
                </div>
                <div class="col-md-3 col-12 mb-2 mb-md-0">
                    <p class="detail-label">Location</p>
                    <p class="detail-value">{{ $restaurant->location }}</p>
                </div>
                <div class="col-md-1 col-3">
                    <p class="detail-label">Rating</p>
                    <p class="detail-value">{{ $restaurant->rating }}</p>
                </div>
                <div class="col-md-2 col-6 text-md-end mt-2 mt-md-0 action-buttons-container">
                    <button class="btn btn-manage toggle-actions-btn" data-id="{{ $restaurant->restaurant_id }}">
                        Manage
                    </button>
                </div>
            </div>

            {{-- Dropdown Action --}}
            <div id="actions-{{ $restaurant->restaurant_id }}" class="row align-items-center actions-dropdown mt-3 justify-content-center">
                <div class="col-auto mx-5">
                    @if ($restaurant->status === 'suspended')
                        <form action="{{ route('admin.management.unsuspend', $restaurant->restaurant_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Unsuspend</button>
                        </form>
                    @elseif ($restaurant->status === 'accepted')
                        <form action="{{ route('admin.management.suspend', $restaurant->restaurant_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning">Suspend</button>
                        </form>
                    @endif
                </div>
                <div class="col-auto mx-5">
                    {{-- Tombol untuk buka modal --}}
                    <button class="btn btn-action btn-contact"
                        data-bs-toggle="modal"
                        data-bs-target="#contactModal{{ $restaurant->restaurant_id }}">
                        Contact
                    </button>
                </div>

                <div class="col-auto mx-5">
                    <button class="btn btn-action btn-close-actions" data-id="{{ $restaurant->restaurant_id }}">
                        Close
                    </button>
                </div>
            </div>
        </div>
    @endforeach

    {{-- SEMUA MODAL DI TARUH DI LUAR LOOP CARD --}}
    @foreach($restaurants as $restaurant)
        <div class="modal fade" id="contactModal{{ $restaurant->restaurant_id }}" tabindex="-1" aria-labelledby="contactModalLabel{{ $restaurant->restaurant_id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content contact-modal-content">
                    <div class="modal-header contact-modal-header">
                        <h5 class="modal-title" id="contactModalLabel{{ $restaurant->restaurant_id }}">
                            Restaurant Contact Information
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body contact-modal-body">
                        <div class="contact-info-item">
                            <p class="contact-label">Contact Person</p>
                            <p class="contact-value">{{ $restaurant->applicant_name ?? 'N/A' }}</p>
                        </div>
                        <div class="contact-info-item">
                            <p class="contact-label">Telephone</p>
                            <p class="contact-value">{{ $restaurant->telephone ?? 'N/A' }}</p>
                        </div>
                        <div class="contact-info-item">
                            <p class="contact-label">Email</p>
                            <p class="contact-value">{{ $restaurant->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/RestoManagementScript.js') }}"></script>
@endpush