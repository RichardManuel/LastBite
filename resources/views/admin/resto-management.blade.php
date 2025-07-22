@extends('admin.layouts.app')

@section('title', 'Restaurant Management')

@section('content')
<div class="container mt-4">
    <h1 class="main-title">Resto Management</h1>
    <p class="sub-title">Please check the following restaurant ratings</p>
    <hr class="line">

    {{-- LIST RESTO --}}
    @foreach($restaurants as $restaurant)
        <div class="management-card" data-id="{{ $restaurant->restaurant_id }}">
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
