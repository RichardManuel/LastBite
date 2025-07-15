@extends('admin.layouts.app')

{{-- Isi judul halaman --}}
@section('title', 'Restaurant Applications')


@section('content')
    <div class="container mt-4">
        <h1 class="main-title">Resto Application</h1>
        <p class="sub-title">Please check the following restaurant applications</p>
        <hr class="line">

    <!-- {{$applications}} -->
     @foreach($applications as $applicant)
        <div class="application-card" id="card-{{ $applicant->id }}">
                <div class="row align-items-center application-summary-row">
                    <div class="col-md-3 mb-3 mb-md-0">
                        <p class="detail-label">Application ID</p>
                        <p class="detail-value">#{{$applicant->id}}</p>
                    </div>
                    <div class="col-md-3 mb-3 mb-md-0">
                        <p class="detail-label">Restaurant</p>
                        <p class="detail-value">{{$applicant->restaurant_name}}</p>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <p class="detail-label">Location</p>
                        <p class="detail-value">{{$applicant->location}}</p>
                    </div>
                    <div class="col-md-2 text-md-end">
                        <button class="btn btn-see-details" type="button" data-bs-toggle="collapse" data-bs-target="#details{{$applicant->id}}" aria-expanded="false" aria-controls="details{{$applicant->id}}">
                            See Details
                        </button>
                    </div>
                </div>

                <div class="collapse" id="details{{$applicant->id}}" data-bs-parent="#applicationAccordion">

                    <div class="application-details-content pb-3">
                        <div class="mb-3">
                            <p class="detail-label">Pictures of Restaurant</p>
                            @if($applicant->picture_of_restaurant)
                                <img src="{{ asset('storage/' . $applicant->picture_of_restaurant) }}"
                                    alt="Picture of {{ $applicant->restaurant_name }}"
                                    class="img-fluid rounded"
                                    style="max-height: 300px; width: auto;">
                            @else
                                <div class="image-placeholder-lg d-flex align-items-center justify-content-center">
                                    <span>No Image Provided</span>
                                </div>
                            @endif
                        </div>

                        <!-- BARIS 1: 4 KOLOM -->
                        <!-- DIUBAH: align-items-stretch menjadi align-items-start -->
                        <div class="row mb-3 d-flex align-items-start">
                            <div class="col-md-3 detail-item-cell">
                                <p class="detail-label">Applicant Name</p>
                                <p class="detail-value">{{$applicant->applicant_name}}</p>
                            </div>
                            <div class="col-md-3 detail-item-cell">
                                <p class="detail-label">Email</p>
                                <p class="detail-value">{{$applicant->email}}</p>
                            </div>
                            <div class="col-md-3 detail-item-cell">
                                <p class="detail-label">Telephone</p>
                                <p class="detail-value">{{$applicant->telephone}}</p>
                            </div>
                            <div class="col-md-3 detail-item-cell">
                                <p class="detail-label">Operational time</p>
                                <p class="detail-value">{{$applicant->operational_time}}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <p class="detail-label">Description</p>
                            <p class="detail-value description-text">{{$applicant->description}}</p>
                        </div>

                        <!-- BARIS 2: 3 KOLOM -->
                        <!-- DIUBAH: align-items-stretch menjadi align-items-start -->
                        <div class="row mb-3 d-flex align-items-start">
                            <div class="col-md-3 detail-item-cell">
                                <p class="detail-label">Type of food sold</p>
                                <p class="detail-value">{{$applicant->food_type}}</p>
                            </div>
                            <div class="col-md-3 detail-item-cell">
                                <p class="detail-label">Pricing</p>
                                <p class="detail-value">{{$applicant->pricing}}</p>
                            </div>
                            <div class="col-md-3 detail-item-cell">
                                <p class="detail-label">Best Before</p>
                                <p class="detail-value">{{$applicant->best_before}}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <p class="detail-label">Picture of Products Sold</p>
                            @if($applicant->picture_of_products)
                                <img src="{{ asset('storage/' . $applicant->picture_of_products) }}"
                                    alt="Picture of {{ $applicant->restaurant_name }}"
                                    class="img-fluid rounded"
                                    style="max-height: 300px; width: auto;">
                            @else
                                <div class="image-placeholder-lg d-flex align-items-center justify-content-center">
                                    <span>No Image Provided</span>
                                </div>
                            @endif
                        </div>

                        <!-- BARIS 3: 2 KOLOM -->
                        <!-- DIUBAH: align-items-stretch menjadi align-items-start -->
                        <div class="row mb-3 d-flex align-items-start">
                            <div class="col-md-3 detail-item-cell">
                                <p class="detail-label">Bank Account</p>
                                <p class="detail-value">{{$applicant->bank_account}}</p>
                            </div>
                            <div class="col-md-3 detail-item-cell">
                                <p class="detail-label">Account Name</p>
                                <p class="detail-value">{{$applicant->account_name}}</p>
                            </div>
                        </div>

                        <!-- BARIS 4: GAMBAR IDENTIFIKASI (3 KOLOM GAMBAR) -->
                        <!-- DIUBAH: align-items-stretch menjadi align-items-start -->
                        <div class="row d-flex align-items-start">
                             <div class="col-md-3 detail-item-cell document-cell">
                                <p class="detail-label">Proof of Identification</p>
                                @if($applicant->proof_of_identification)
                                    <img src="{{ asset('storage/' . $applicant->proof_of_identification) }}"
                                        alt="Picture of {{ $applicant->restaurant_name }}"
                                        class="img-fluid rounded"
                                        style="max-height: 1000px; width: auto;">
                                @else
                                    <div class="image-placeholder-lg d-flex align-items-center justify-content-center">
                                        <span>No Image Provided</span>
                                    </div>
                                @endif
                                </div>
                            <div class="col-md-3 detail-item-cell document-cell">
                                <p class="detail-label">NPWP</p>
                                 @if($applicant->npwp)
                                    <img src="{{ asset('storage/' . $applicant->npwp) }}"
                                        alt="Picture of {{ $applicant->restaurant_name }}"
                                        class="img-fluid rounded"
                                        style="max-height: 1000px; width: auto;">
                                @else
                                    <div class="image-placeholder-lg d-flex align-items-center justify-content-center">
                                        <span>No Image Provided</span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-3 detail-item-cell document-cell">
                                <p class="detail-label">Letter of authorization</p>
                                @if($applicant->letter_of_authorization)
                                    <img src="{{ asset('storage/' . $applicant->letter_of_authorization) }}"
                                        alt="Picture of {{ $applicant->restaurant_name }}"
                                        class="img-fluid rounded"
                                        style="max-height: 1000px; width: auto;">
                                @else
                                    <div class="image-placeholder-lg d-flex align-items-center justify-content-center">
                                        <span>No Image Provided</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-danger action-button" data-action="decline" data-id="{{ $applicant->id }}">
                            Decline <i class="bi bi-x-circle"></i>
                        </button>
                        <button type="button" class="btn btn-success action-button ms-3"  data-action="accept" data-id="{{ $applicant->id }}">
                            Accept <i class="bi bi-check-circle"></i>
                        </button>
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
    <script src="{{ asset('js/RestoApplicationScript.js') }}"></script>
    <!-- <script src="{{ asset('js/RestoManagementScript.js') }}"></script> -->
@endpush
