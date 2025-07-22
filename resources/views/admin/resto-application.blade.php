@extends('admin.layouts.app')

{{-- Isi judul halaman --}}
@section('title', 'Restaurant Applications')


@section('content')
    <div class="container mt-4" >
        <h1 class="main-title">Resto Application</h1>
        <p class="sub-title">Please check the following restaurant applications</p>
        <hr class="line">

        @if ($restaurants->isEmpty())
            <div class="text-center mt-5 fs-5 mb-5" style="color: #ff1919ff; font-weight: 500; background-color: transparent;">
                🍽️ <strong>No restaurant applications found.</strong><br>
                Please check back later.
            </div>
        @else
            <!-- {{ $restaurants }} -->
            @foreach ($restaurants as $restaurant)
                <div class="application-card" id="card-{{ $restaurant->restaurant_id }}">
                    <div class="row align-items-center application-summary-row">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <p class="detail-label">Restaurant ID</p>
                            <p class="detail-value">#{{ $restaurant->restaurant_id }}</p>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <p class="detail-label">Restaurant</p>
                            <p class="detail-value">{{ $restaurant->name }}</p>
                        </div>
                        <div class="col-md-4 mb-3 mb-md-0">
                            <p class="detail-label">Location</p>
                            <p class="detail-value">{{ $restaurant->location }}</p>
                        </div>
                        <div class="col-md-2 text-md-end">
                            <button class="btn btn-see-details" type="button" data-bs-toggle="collapse"
                                data-bs-target="#details{{ $restaurant->restaurant_id }}" aria-expanded="false"
                                aria-controls="details{{ $restaurant->restaurant_id }}">
                                See Details
                            </button>
                        </div>
                    </div>

                    <div class="collapse" id="details{{ $restaurant->restaurant_id }}" data-bs-parent="#applicationAccordion">

                        <div class="application-details-content pb-3">
                            <div class="mb-3">
                                <p class="detail-label">Pictures of Restaurant</p>
                                @if ($restaurant->restaurant_picture_path)
                                    <img src="{{ asset('storage/' . $restaurant->restaurant_picture_path) }}"
                                        alt="Picture of {{ $restaurant->name }}" class="img-fluid rounded"
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
                                    <p class="detail-value">{{ $restaurant->applicant_name }}</p>
                                </div>
                                <div class="col-md-3 detail-item-cell">
                                    <p class="detail-label">Email</p>
                                    <p class="detail-value">{{ $restaurant->email }}</p>
                                </div>
                                <div class="col-md-3 detail-item-cell">
                                    <p class="detail-label">Telephone</p>
                                    <p class="detail-value">{{ $restaurant->telephone }}</p>
                                </div>
                                <div class="col-md-3 detail-item-cell">
                                    <p class="detail-label">Operational time</p>
                                    <p class="detail-value">{{ $restaurant->operational_hours }}</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <p class="detail-label">Description</p>
                                <p class="detail-value description-text">{{ $restaurant->description }}</p>
                            </div>

                            <!-- BARIS 2: 3 KOLOM -->
                            <!-- DIUBAH: align-items-stretch menjadi align-items-start -->
                            <div class="row mb-3 d-flex align-items-start">
                                <div class="col-md-3 detail-item-cell">
                                    <p class="detail-label">Type of food sold</p>
                                    <p class="detail-value">{{ $restaurant->food_type }}</p>
                                </div>
                                <div class="col-md-3 detail-item-cell">
                                    <p class="detail-label">Pricing</p>
                                    <p class="detail-value">{{ $restaurant->pricing_tier }}</p>
                                </div>
                                <div class="col-md-3 detail-item-cell">
                                    <p class="detail-label">Best Before</p>
                                    <p class="detail-value">{{ $restaurant->best_before }}</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <p class="detail-label">Picture of Products Sold</p>
                                @if ($restaurant->product_sold_picture_path)
                                    <img src="{{ asset('storage/' . $restaurant->product_sold_picture_path) }}"
                                        alt="Picture of {{ $restaurant->name }}" class="img-fluid rounded"
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
                                    <p class="detail-value">{{ $restaurant->account_bank }}</p>
                                </div>
                                <div class="col-md-3 detail-item-cell">
                                    <p class="detail-label">Account Name</p>
                                    <p class="detail-value">{{ $restaurant->bank_account_name }}</p>
                                </div>
                            </div>

                            <!-- BARIS 4: GAMBAR IDENTIFIKASI (3 KOLOM GAMBAR) -->
                            <!-- DIUBAH: align-items-stretch menjadi align-items-start -->
                            <div class="row d-flex align-items-start">
                                <div class="col-md-3 detail-item-cell document-cell">
                                    <p class="detail-label">Proof of Identification</p>
                                    @if ($restaurant->id_proof_document_path)
                                        <img src="{{ asset('storage/' . $restaurant->id_proof_document_path) }}"
                                            alt="Picture of {{ $restaurant->name }}" class="img-fluid rounded"
                                            style="max-height: 1000px; width: auto;">
                                    @else
                                        <div class="image-placeholder-lg d-flex align-items-center justify-content-center">
                                            <span>No Image Provided</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-3 detail-item-cell document-cell">
                                    <p class="detail-label">NPWP</p>
                                    @if ($restaurant->npwp_document_path)
                                        <img src="{{ asset('storage/' . $restaurant->npwp_document_path) }}"
                                            alt="Picture of {{ $restaurant->name }}" class="img-fluid rounded"
                                            style="max-height: 1000px; width: auto;">
                                    @else
                                        <div class="image-placeholder-lg d-flex align-items-center justify-content-center">
                                            <span>No Image Provided</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-3 detail-item-cell document-cell">
                                    <p class="detail-label">Letter of authorization</p>
                                    @if ($restaurant->authorization_document_path)
                                        <img src="{{ asset('storage/' . $restaurant->authorization_document_path) }}"
                                            alt="Picture of {{ $restaurant->restaurant_name }}" class="img-fluid rounded"
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
                            <button type="button" class="btn btn-danger action-button" data-action="decline"
                                data-id="{{ $restaurant->restaurant_id }}">
                                Decline <i class="bi bi-x-circle"></i>
                            </button>
                            <button type="button" class="btn btn-success action-button ms-3" data-action="accept"
                                data-id="{{ $restaurant->restaurant_id }}">
                                Accept <i class="bi bi-check-circle"></i>
                            </button>
                        </div>

                    </div>
                </div>
            @endforeach
        @endif    
@endsection

@push('scripts')
    <script src="{{ asset('js/RestoApplicationScript.js') }}"></script>
    <!-- <script src="{{ asset('js/RestoManagementScript.js') }}"></script> -->
@endpush
