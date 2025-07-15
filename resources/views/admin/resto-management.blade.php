@extends('layouts.app')

{{-- Isi judul halaman --}}
@section('title', 'Restaurant Management')


@section('content')
    <div class="container mt-4">
        <h1 class="main-title">Resto Management</h1>
        <p class="sub-title">Please check the following restaurant ratings</p>
        <hr class="line">

        @foreach($restaurants as $restaurant)
                <div class="management-card" data-id="{{$restaurant->id}}">
                    <div class="row align-items-center summary-row">
                        <div class="col-md-2 col-6 mb-2 mb-md-0">
                            <p class="detail-label">Restaurant ID</p>
                            <p class="detail-value">#{{$restaurant->id}}</p>
                        </div>
                        <div class="col-md-3 col-6 mb-2 mb-md-0">
                            <p class="detail-label">Restaurant</p>
                            <p class="detail-value">{{$restaurant->name}}</p>
                        </div>
                        <div class="col-md-3 col-12 mb-2 mb-md-0">
                            <p class="detail-label">Location</p>
                            <p class="detail-value">{{$restaurant->location}}</p>
                        </div>
                        <div class="col-md-1 col-3">
                            <p class="detail-label">Rating</p>
                            <p class="detail-value">{{$restaurant->rating}}</p>
                        </div>
                        <div class="col-md-1 col-3">
                            <p class="detail-label">Reviews</p>
                            <p class="detail-value">{{$restaurant->reviews_count}}</p>
                        </div>
                        <div class="col-md-2 col-6 text-md-end mt-2 mt-md-0 action-buttons-container">
                            <button class="btn btn-manage">Manage</button>
                        </div>
                    </div>
                    <!-- === UPDATED ACTIONS ROW === -->
                    <div class="row align-items-center actions-row mt-3 justify-content-center" style="display: none;">
                        <div class="col-auto mx-5">
                            <button class="btn btn-action btn-suspend" data-id="{{ $restaurant->id }}">Suspend</button>
                        </div>
                        <div class="col-auto mx-5">
                           <button class="btn btn-action btn-contact" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#contactModal{{ $restaurant->id }}"
                                    data-name="{{ $restaurant->application?->applicant_name ?? 'Not Available' }}"
                                    data-phone="{{ $restaurant->application?->telephone ?? 'Not Available' }}"
                                    data-email="{{ $restaurant->application?->email ?? 'Not Available' }}">
                                Contact
                            </button>
                        </div>
                        <div class="col-auto mx-5">
                            <button class="btn btn-action btn-close-actions">Close</button>
                        </div>
                    </div>

                </div>

                <div class="modal fade" id="contactModal{{ $restaurant->id }}" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content contact-modal-content">
                            <div class="modal-header contact-modal-header">
                                <h5 class="modal-title" id="contactModalLabel">Restaurant Contact Information</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body contact-modal-body">
                                <div class="contact-info-item">
                                    <p class="contact-label">Applicator</p>
                                    <p class="contact-value">{{ $restaurant->application?->applicant_name ?? 'N/A' }}</p>
                                </div>
                                <div class="contact-info-item">
                                    <p class="contact-label">Telephone</p>
                                    <p class="contact-value">{{ $restaurant->application?->telephone ?? 'N/A' }}</p>
                                </div>
                                <div class="contact-info-item">
                                    <p class="contact-label">Email</p>
                                    <p class="contact-value" >{{ $restaurant->application?->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        @endforeach
    </div>
    <!-- <div id="applicationAccordion">
        <p class="text-center">Loading...</p>
    </div> -->

@endsection

@push('scripts')
    <!-- <script src="{{ asset('js/RestoApplicationScript.js') }}"></script> -->
    <script src="{{ asset('js/RestoManagementScript.js') }}"></script>
@endpush