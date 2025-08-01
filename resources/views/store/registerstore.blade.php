<!-- resources/views/auth/registerstore.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Eatery - Register Your Eatery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Instrument+Serif:ital@0;1&display=swap"
        rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            --brand-orange-accent: #F9A826;
            --brand-text-dark: #3A2E39;
            --brand-text-muted: #6c757d;
            --input-bg: #F0F0F0;
            --font-serif-display: 'Instrument Serif', serif;
            --font-sans-body: 'Instrument Sans', sans-serif;
            --upload-area-bg: #F0F0F0;
            --upload-area-border: #E0E0E0;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Instrument Sans', sans-serif;
            background-color: #FFFFFF;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .register-store-container {
            width: 100%;
            max-width: 700px;
            text-align: left;
        }

        .register-store-container .eatery-title {
            font-family: var(--font-serif-display);
            color: var(--brand-text-dark);
            font-size: 4.2rem;
            font-weight: 500;
            margin-bottom: 1.4rem;
        }

        .register-store-container .register-title {
            font-family: var(--font-serif-display);
            color: var(--brand-orange-accent);
            font-size: 3rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .register-store-container .sub-heading {
            font-size: 0.9rem;
            color: var(--brand-text-muted);
            margin-bottom: 2rem;
        }

        .form-label-custom {
            text-align: left !important;
            font-size: 0.875rem;
            color: var(--brand-text-dark);
            margin-bottom: 0.3rem;
            font-weight: 500;
        }

        .form-control-custom {
            background-color: var(--input-bg);
            border: none;
            border-radius: 0.375rem;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            color: #495057;
            width: 100%;
        }

        .form-control-custom::placeholder {
            color: #888;
        }

        .form-control-custom:focus {
            background-color: var(--input-bg);
            border-color: var(--brand-orange-accent);
            box-shadow: 0 0 0 0.2rem rgba(249, 168, 38, 0.25);
        }

        textarea.form-control-custom {
            min-height: 80px;
        }

        .image-upload-area {
            background-color: var(--upload-area-bg);
            border: 1px dashed var(--upload-area-border);
            border-radius: 0.375rem;
            text-align: center;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--brand-text-muted);
            height: 150px;
            font-size: 0.85rem;
            transition: background-color 0.2s ease;
        }

        .image-upload-area:hover {
            background-color: #e9e9e9;
        }

        .image-upload-area i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .image-upload-area.small-upload {
            height: 100px;
            font-size: 0.75rem;
        }

        .image-upload-area.small-upload i {
            font-size: 1.5rem;
        }

        .image-upload-area input[type="file"] {
            display: none;
        }

        .btn-apply-custom {
            background-color: #F3C148;
            color: white;
            font-weight: 500;
            padding: 0.8rem 0;
            border-radius: 0.375rem;
            font-size: 1.05rem;
            border: none;
            transition: background-color 0.2s ease-in-out;
        }

        .btn-apply-custom:hover {
            background-color: #e0931f;
            color: white;
        }

        .alert-custom ul {
            margin-bottom: 0;
            padding-left: 1.25rem;
        }

        .required-asterisk {
            color: red;
            margin-left: 2px;
        }

        .form-section {
            margin-bottom: 1.8rem;
        }

        .image-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0.375rem;
            display: none;
        }
    </style>
</head>

<body>

    <!-- Tanpa Navbar -->

    <!-- Main Content for Register Store Form -->
    <main class="main-content">
        <div class="register-store-container">
            <h2 class="eatery-title" style="text-align: center">My Eatery</h2>
            <h1 class="register-title" style="text-align: center">Register Your Eatery</h1>
            <p class="sub-heading" style="text-align: center">
                Got leftovers? Turn them into profits by joining our surprise bag program.
            </p>

            @if (session('success'))
                <div class="alert alert-success alert-custom mb-3">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-custom mb-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM REGISTRASI (TIDAK BERUBAH) --}}
            <form method="POST" action="{{ route('resto.register.details.submit') }}" enctype="multipart/form-data">
                @csrf
               <div class="form-section">
                    <div class="mb-3">
                        <label for="application_name" class="form-label-custom">Application Name<span
                                class="required-asterisk">*</span></label>
                        <input id="application_name" type="text"
                            class="form-control form-control-custom @error('application_name') is-invalid @enderror"
                            name="application_name" value="{{ old('application_name') }}" required
                            placeholder="e.g. John Doe - Eatery Application">
                        @error('application_name')
                            <span
                                class="invalid-feedback d-block text-start"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label-custom">Telephone<span
                                class="required-asterisk">*</span></label>
                        <input id="telephone" type="tel"
                            class="form-control form-control-custom @error('telephone') is-invalid @enderror"
                            name="telephone" value="{{ old('telephone') }}" required placeholder="e.g. 08123456789">
                        @error('telephone')
                            <span
                                class="invalid-feedback d-block text-start"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                    </div>
                </div>

                <div class="form-section">
                    <div class="mb-3">
                        <label for="name" class="form-label-custom">Restaurant Name<span
                                class="required-asterisk">*</span></label>
                        <input id="name" type="text"
                            class="form-control form-control-custom @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required placeholder="Official Name of Your Eatery">
                        @error('name')
                            <span
                                class="invalid-feedback d-block text-start"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label-custom">Location (Full Address)<span
                                class="required-asterisk">*</span></label>
                        <textarea id="location" class="form-control form-control-custom @error('location') is-invalid @enderror"
                            name="location" rows="3" required placeholder="Street, City, Postal Code">{{ old('location') }}</textarea>
                        @error('location')
                            <span
                                class="invalid-feedback d-block text-start"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                    </div>
                </div>

                <div class="form-section row">
                    <div class="col-md-6 mb-3">
                        <label for="food_type" class="form-label-custom">food_type<span
                                class="required-asterisk">*</span></label>
                        <input id="food_type" type="text"
                            class="form-control form-control-custom @error('food_type') is-invalid @enderror"
                            name="food_type" value="{{ old('food_type') }}" required
                            placeholder="e.g., Bakery, Indonesian, Cafe">
                        @error('food_type')
                            <span
                                class="invalid-feedback d-block text-start"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="operational_hours" class="form-label-custom">Operational Hours<span
                                class="required-asterisk">*</span></label>
                        <input id="operational_hours" type="text"
                            class="form-control form-control-custom @error('operational_hours') is-invalid @enderror"
                            name="operational_hours" value="{{ old('operational_hours') }}" required
                            placeholder="e.g., 09:00 AM - 09:00 PM">
                        @error('operational_hours')
                            <span
                                class="invalid-feedback d-block text-start"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                    </div>
                </div>

                <div class="form-section row">
                    <div class="col-md-6 mb-3">
                        <label for="pricing" class="form-label-custom">Pricing (Avg. per surprise bag)<span
                                class="required-asterisk">*</span></label>
                        <input id="pricing" type="text"
                            class="form-control form-control-custom @error('pricing') is-invalid @enderror"
                            name="pricing" value="{{ old('pricing') }}" required placeholder="e.g., IDR 25000">
                        @error('pricing')
                            <span
                                class="invalid-feedback d-block text-start"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="best_before" class="form-label-custom">Best Before</label>
                        <input id="best_before" type="text"
                            class="form-control form-control-custom @error('best_before') is-invalid @enderror"
                            name="best_before"
                            value="{{ old('best_before', isset($restaurant->best_before) ? \Carbon\Carbon::parse($restaurant->best_before)->format('Y-m-d') : '') }}">

                        @error('best_before')
                            <span
                                class="invalid-feedback d-block text-start"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                    </div>
                </div>

                <div class="form-section mb-3">
                    <label for="description" class="form-label-custom">Description<span
                            class="required-asterisk">*</span></label>
                    <textarea id="description" class="form-control form-control-custom @error('description') is-invalid @enderror"
                        name="description" rows="4" required
                        placeholder="Tell us about your eatery and what kind of items might be in a surprise bag.">{{ old('description') }}</textarea>
                    @error('description')
                        <span
                            class="invalid-feedback d-block text-start"><small><strong>{{ $message }}</strong></small></span>
                    @enderror
                </div>

                <div class="form-section row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="restaurant_picture" class="form-label-custom">Restaurant Picture</label>
                        <label for="restaurant_picture_input" class="image-upload-area" tabindex="0"
                            role="button" aria-describedby="restaurantPictureHelp">
                            <i class="bi bi-camera"></i>
                            <span>Add Restaurant Picture</span>
                            <input type="file" id="restaurant_picture_input" name="restaurant_picture"
                                class="form-control @error('restaurant_picture') is-invalid @enderror"
                                accept="image/*">
                            <img id="restaurant_picture_preview" class="image-preview" alt="Preview">
                        </label>
                        @error('restaurant_picture')
                            <span
                                class="invalid-feedback d-block text-start mt-1"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                        <small id="restaurantPictureHelp" class="form-text text-muted d-block text-center mt-1">Image
                            of your storefront or ambiance.</small>
                    </div>
                    <div class="col-md-6">
                        <label for="product_sold_picture" class="form-label-custom">Product Sold Picture</label>
                        <label for="product_sold_picture_input" class="image-upload-area" tabindex="0"
                            role="button" aria-describedby="productPictureHelp">
                            <i class="bi bi-camera"></i>
                            <span>Add Product Sold Picture</span>
                            <input type="file" id="product_sold_picture_input" name="product_sold_picture"
                                class="form-control @error('product_sold_picture') is-invalid @enderror"
                                accept="image/*">
                            <img id="product_sold_picture_preview" class="image-preview" alt="Preview">
                        </label>

                        @error('product_sold_picture')
                            <span
                                class="invalid-feedback d-block text-start mt-1"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                        <small id="productPictureHelp" class="form-text text-muted d-block text-center mt-1">Example
                            of products you sell.</small>
                    </div>
                </div>

                <div class="form-section row">
                    <div class="col-md-6 mb-3">
                        <label for="bank_account" class="form-label-custom">Bank Account Number<span
                                class="required-asterisk">*</span></label>
                        <input id="bank_account" type="text"
                            class="form-control form-control-custom @error('bank_account') is-invalid @enderror"
                            name="bank_account" value="{{ old('bank_account') }}" required>
                        @error('bank_account')
                            <span
                                class="invalid-feedback d-block text-start"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="account_name" class="form-label-custom">Account Name (as in bank)<span
                                class="required-asterisk">*</span></label>
                        <input id="account_name" type="text"
                            class="form-control form-control-custom @error('account_name') is-invalid @enderror"
                            name="account_name" value="{{ old('account_name') }}" required>
                        @error('account_name')
                            <span
                                class="invalid-feedback d-block text-start"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                    </div>
                </div>

                <div class="form-section row text-center">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="proof_id_input" class="image-upload-area small-upload" tabindex="0"
                            role="button">
                            <i class="bi bi-camera"></i>
                            <span>Add Proof of Identification Picture</span>
                            <input type="file" id="proof_id_input" name="proof_of_identification_picture"
                                class="form-control @error('proof_of_identification_picture') is-invalid @enderror"
                                accept="image/*">
                            <img id="proof_of_identification_picture_preview" class="image-preview" alt="Preview">
                        </label>

                        @error('proof_of_identification_picture')
                            <span
                                class="invalid-feedback d-block text-start mt-1"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label for="npwp_input" class="image-upload-area small-upload" tabindex="0"
                            role="button">
                            <i class="bi bi-camera"></i>
                            <span>Add NPWP Picture</span>
                            <input type="file" id="npwp_input" name="npwp_picture"
                                class="form-control @error('npwp_picture') is-invalid @enderror" accept="image/*">
                            <img id="npwp_picture_preview" class="image-preview" alt="Preview">
                        </label>

                        @error('npwp_picture')
                            <span
                                class="invalid-feedback d-block text-start mt-1"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="letter_auth_input" class="image-upload-area small-upload" tabindex="0"
                            role="button">
                            <i class="bi bi-camera"></i>
                            <span>Add Letter of Authorization of food retail Picture</span>
                            <input type="file" id="letter_auth_input" name="letter_of_authorization_picture"
                                class="form-control @error('letter_of_authorization_picture') is-invalid @enderror"
                                accept="image/*">
                            <img id="letter_of_authorization_picture_preview" class="image-preview" alt="Preview">
                        </label>

                        @error('letter_of_authorization_picture')
                            <span
                                class="invalid-feedback d-block text-start mt-1"><small><strong>{{ $message }}</strong></small></span>
                        @enderror
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-apply-custom w-100">Apply</button>
                </div>
            </form>
        </div>
    </main>

    <!-- Tanpa Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        // Script preview upload gambar tetap dipertahankan
        document.querySelectorAll('.image-upload-area').forEach(uploadArea => {
            const fileInput = uploadArea.querySelector('input[type="file"]');
            const previewImage = uploadArea.querySelector('img.image-preview');
            const icon = uploadArea.querySelector('i');
            const span = uploadArea.querySelector('span');

            if (fileInput && previewImage) {
                fileInput.addEventListener('change', (event) => {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = e => {
                            previewImage.src = e.target.result;
                            previewImage.style.display = 'block';
                            if (icon) icon.style.display = 'none';
                            if (span) span.style.display = 'none';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        previewImage.src = '';
                        previewImage.style.display = 'none';
                        if (icon) icon.style.display = '';
                        if (span) span.style.display = '';
                    }
                });
            }
        });
    </script>
</body>

</html>
