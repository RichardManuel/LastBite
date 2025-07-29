{{-- resources/views/checkout/reserved.blade.php --}}
@extends('user.layouts.app')

@section('title', 'Reserved - Checkout')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/reserved.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="checkout-container">

            {{-- Checkout Title --}}
            <div class="checkout-title-container">
                <hr>
                <span class="checkout-title-text">Checkout</span>
                <hr>
            </div>

            {{-- Progress Bar --}}
            <div class="checkout-progress-bar">
                <div class="step active">
                    <div class="circle">1</div>
                    <div class="label">Reserved</div>
                </div>
                <div class="step">
                    <div class="circle">2</div>
                    <div class="label">Review & Pay</div>
                </div>
                <div class="step">
                    <div class="circle">3</div>
                    <div class="label">Confirmation</div>
                </div>
            </div>

            {{-- Error Message --}}
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <h2 class="reserved-info-title">Reserved Information</h2>

            {{-- Form --}}
            <form action="{{ route('checkout.pickup.update') }}" method="POST">
                @csrf
                <input type="hidden" name="customer_name" value="{{ auth()->user()->name }}">
                <input type="hidden" name="pickup_id" id="pickup_id_input">
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->restaurant_id }}">
                <input type="hidden" name="item_name" value="Surprise Bag">
                <input type="hidden" name="item_price" value="{{ $restaurant->pricing_tier }}">


                <div class="row gx-4">
                    {{-- Left Column: Eatery Info --}}
                    <div class="col-lg-7 mb-4 mb-lg-0">
                        <div class="eatery-detail-card">
                            <div class="eatery-detail">
                                <h3>Eatery Detail</h3>
                                <h4>{{ $restaurant->name ?? 'Store Name' }}</h4>
                                <p>{{ $restaurant->location ?? 'Address not available' }}</p>
                                <div class="pick-up-time">
                                    <strong>Pick up time</strong>
                                    <p id="pickup-time-display">
                                        @if ($pickup)
                                            {{ $pickup->time_type }} : {{ $pickup->start_time }} - {{ $pickup->end_time }}
                                        @else
                                            Haven't selected a time yet
                                        @endif
                                    </p>

                                </div>
                                <div class="phone-info">
                                    <i class="bi bi-telephone-fill"></i>
                                    <span>{{ $restaurant->telephone ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="https://www.google.com/maps?q={{ urlencode($restaurant->location ?? '') }}"
                                    target="_blank" class="btn btn-show-location w-auto mt-5">Show Location</a>
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Customer Info --}}
                    <div class="col-lg-5">
                        <div class="user-info-section">
                            <h3>{{ $user->name ?? 'Guest' }}</h3>

                            <div class="info-item">
                                <strong>Email</strong>
                                <span>{{ $user->email ?? '-' }}</span>
                            </div>

                            <div class="info-item">
                                <strong>City</strong>
                                <span>{{ $user->city ?? '-' }}</span>
                            </div>

                            <div class="info-item">
                                <strong>Phone</strong>
                                <span>{{ $user->phone ?? '-' }}</span>
                            </div>

                            {{-- Pickup Time --}}
                            <div class="info-item">
                                <strong class="custom-text d-block mb-2">Select pick up time</strong>
                                <div class="d-flex gap-2">
                                    <input type="radio" class="btn-check" name="pickup_time" id="lunch" value="Lunch"
                                        checked>
                                    <label class="btn btn-pickup" for="lunch">Lunch</label>

                                    <input type="radio" class="btn-check" name="pickup_time" id="dinner"
                                        value="Dinner">
                                    <label class="btn btn-pickup" for="dinner">Dinner</label>
                                </div>
                            </div>

                            {{-- Notes --}}
                            <div class="form-group mt-3">
                                <label for="notes" class="form-label"
                                    style="color: var(--primary-green); font-weight: bold;">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Add any notes here..."></textarea>
                            </div>

                            {{-- Submit --}}
                            <button type="submit" class="btn btn-confirm w-100 mt-4">Review Your Order</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const pickupData = @json($pickups);

        document.querySelectorAll('input[name="pickup_time"]').forEach((radio) => {
            radio.addEventListener('change', function() {
                const selectedType = this.value;

                let pickupId = null;
                if (selectedType === 'Lunch') {
                    pickupId = 1;
                } else if (selectedType === 'Dinner') {
                    pickupId = 2;
                }

                // Menampilkan informasi jam bisa tetap seperti ini kalau perlu
                const found = pickupData.find(p => p.time_type === selectedType);
                if (found) {
                    const display =
                        `${found.time_type} : ${formatTime(found.start_time)} - ${formatTime(found.end_time)}`;
                    document.getElementById('pickup-time-display').textContent = display;
                }

                // Assign pickup ID langsung
                document.getElementById('pickup_id_input').value = pickupId;
            });

        });

        function formatTime(timeStr) {
            const [hours, minutes] = timeStr.split(':');
            const h = parseInt(hours);
            const ampm = h >= 12 ? 'PM' : 'AM';
            const hour12 = h % 12 || 12;
            return `${hour12}:${minutes} ${ampm}`;
        }
    </script>
@endpush
