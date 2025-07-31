@extends('user.layouts.app')

@section('title', 'Your Orders - LastBite')

@push('styles')
    {{-- Link to your new custom CSS for order user page --}}
    <link rel="stylesheet" href="{{ asset('css/orderuser.css') }}">
    <style>
        /* Styling for the clickable area of the order card */
        .order-details-area-link {
            text-decoration: none;
            /* Remove underline */
            color: inherit;
            /* Inherit text color */
            display: block;
            /* Make the link fill its container */
            cursor: pointer;
            /* Indicate it's clickable */
            padding: 15px;
            /* Add padding to the clickable area */
            /* No border-bottom here, use hr for separation if needed */
        }

        .order-details-area-link:hover {
            background-color: #f9f9f9;
            /* Subtle hover effect for the clickable area */
        }

        /* Ensure the order-card itself is styled */
        .order-card {
            border-radius: 0.75rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
            background-color: white;
            margin-bottom: 20px;
            padding: 0;
            /* Remove padding from here as it's now on sub-elements */
            overflow: hidden;
            /* Ensures rounded corners apply correctly */
        }

        /* Adjust order-details-row if needed, it's now inside order-details-area-link */
        .order-card .order-details-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            /* No padding here, it's on .order-details-area-link */
        }

        /* Styling for the rating/actions section */
        .order-rating-actions-section {
            padding: 15px;
            /* Padding for the actions section */
            padding-top: 0;
            /* No top padding if hr is used */
        }

        .order-rating-actions-section .d-flex {
            justify-content: flex-end;
            /* Align button to the right */
            margin-bottom: 10px;
            /* Space between button and rating display */
        }
    </style>
@endpush

@section('content')
    <main class="container my-5">
        <div class="order-header">
            <div>
                <h1>Order.</h1>
                <p>Grab your meal before it's gone!</p>
            </div>
            <div class="order-tabs">
                {{-- Filter buttons --}}
                <button class="btn btn-outline-secondary {{ $filter === 'all' || is_null($filter) ? 'active' : '' }}"
                    data-filter="all">All Order</button>
                <button class="btn btn-outline-secondary {{ $filter === 'ongoing' ? 'active' : '' }}"
                    data-filter="ongoing">Ongoing</button>
                <button class="btn btn-outline-secondary {{ $filter === 'completed' ? 'active' : '' }}"
                    data-filter="completed">Completed</button>
                <button class="btn btn-outline-secondary {{ $filter === 'cancelled' ? 'active' : '' }}"
                    data-filter="cancelled">Cancelled</button>
                <button class="btn btn-outline-secondary {{ $filter === 'rated' ? 'active' : '' }}"
                    data-filter="rated">Rating</button>
            </div>
        </div>

        @forelse($orders as $order)
            {{-- Determine the URL for the confirmation page --}}
            @php
                $confirmationUrl = '#'; // Default fallback (e.g., for non-completed orders)
                if ($order->isCompleted() && $order->stripe_session_id) {
                    // If completed and has a Stripe Session ID, use the real confirmation URL
                    $confirmationUrl = route('checkout.success', ['session_id' => $order->stripe_session_id]);
                }
                // Jika order completed tapi stripe_session_id null (misal, data dummy lama),
                // maka akan tetap '#' atau Anda bisa menambahkan pesan/perilaku spesifik.
                // Untuk produksi, semua order completed seharusnya punya stripe_session_id.
            @endphp

            <div class="order-card p-3 border mb-3" data-order-db-id="{{ $order->id }}">
                {{-- Container for clickable order details --}}
                <a href="{{ $confirmationUrl }}" class="order-details-area-link">
                    <div class="order-details-row">
                        <div class="order-detail-item">
                            <p>Order ID</p>
                            <strong>#{{ $order->order_id }}</strong>
                        </div>
                        <div class="order-detail-item">
                            <p>Restaurant</p>
                            <strong>{{ $order->restaurant->name }}</strong>
                        </div>
                        <div class="order-detail-item">
                            <p>Pickup Time</p>
                            <strong>{{ $order->pickup->time_type ?? 'N/A' }}</strong>
                        </div>
                        <div class="order-detail-item">
                            <p>Status</p>
                            <strong>{{ $order->status ?? 'N/A' }}</strong>
                        </div>
                        <div class="order-detail-item">
                            <p>Total</p>
                            <strong>Rp {{ number_format($order->item_price, 2, ',', '.') }}</strong>
                        </div>
                    </div>
                </a>

                {{-- Container for rating/status actions --}}
                <div class="order-rating-actions-section">
                    <hr class="my-3"> {{-- Separator --}}
                    <div class="d-flex justify-content-end align-items-center">
                        {{-- Conditional logic for "Rate Now" button --}}
                        @if ($order->isCompleted() && !$order->isRated())
                            <button type="button" class="btn btn-success rate-now-btn" data-bs-toggle="modal"
                                data-bs-target="#ratingModal" data-order-id="{{ $order->order_id }}"
                                data-order-db-id="{{ $order->id }}"
                                data-restaurant-name="{{ $order->restaurant->name }}">
                                Rate Now
                            </button>
                        @elseif($order->isRated())
                            <button type="button" class="btn btn-secondary" disabled>Rated</button>
                        @else
                            {{-- Display status for non-completed orders --}}
                            <button type="button" class="btn btn-info" disabled>{{ ucfirst($order->status) }}</button>
                        @endif
                    </div>

                    {{-- Display existing rating if the order is completed and rated --}}
                    @if ($order->isCompleted() && $order->isRated())
                        <div class="rating-section text-center mt-3">
                            <p class="mb-2">Your Rating for {{ $order->restaurant->name }}:</p>
                            <div class="rating-stars display-only" style="font-size: 1.5rem;">
                                @for ($i = 5; $i >= 1; $i--)
                                    <label class="{{ $order->rating->rating >= $i ? 'active' : '' }}">
                                        {!! $order->rating->rating >= $i ? '★' : '☆' !!}
                                    </label>
                                @endfor
                            </div>
                            @if ($order->rating->review)
                                <p class="mt-2 text-muted">"{{ $order->rating->review }}"</p>
                            @endif
                        </div>
                    @endif
                </div>

            </div>
        @empty
            <div class="alert alert-info text-center" role="alert">
                No orders found.
            </div>
        @endforelse
    </main>

    {{-- Rating Modal (remains unchanged) --}}
    <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="ratingModalLabel">Rate Your Order</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ratingForm">
                        @csrf
                        <input type="hidden" id="modalOrderDbId" name="order_id">
                        <input type="hidden" id="modalOrderIdDisplayHidden">
                        <input type="hidden" id="modalRestaurantNameDisplayHidden">

                        <p>How would you rate your experience with
                            <strong><span id="restaurantNameInModal"></span></strong>
                            for order <strong><span id="orderIdInModal"></span></strong>?
                        </p>

                        <div class="text-center mb-3">
                            <div class="rating-stars">
                                <input type="radio" id="star5" name="rating" value="5" />
                                <label for="star5">★</label>
                                <input type="radio" id="star4" name="rating" value="4" />
                                <label for="star4">★</label>
                                <input type="radio" id="star3" name="rating" value="3" />
                                <label for="star3">★</label>
                                <input type="radio" id="star2" name="rating" value="2" />
                                <label for="star2">★</label>
                                <input type="radio" id="star1" name="rating" value="1" />
                                <label for="star1">★</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="reviewText" class="form-label">Your Review (optional)</label>
                            <textarea id="reviewText" class="form-control" name="review" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="ratingForm" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ratingModal = document.getElementById('ratingModal');
            const ratingForm = document.getElementById('ratingForm');
            const filterButtons = document.querySelectorAll('.order-tabs .btn');

            // Function to update star visuals based on a given rating
            function updateStarDisplay(container, currentRating) {
                const labels = container.querySelectorAll('label');
                labels.forEach(label => {
                    const starValue = parseInt(label.htmlFor ? label.htmlFor.replace('star', '') : label
                        .dataset.value || 0);

                    if (starValue <= currentRating) {
                        label.innerHTML = '★'; // Solid star
                    } else {
                        label.innerHTML = '☆'; // Outline star
                    }
                });
            }

            // Event listener for when the modal is shown
            ratingModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const orderIdDisplay = button.getAttribute('data-order-id');
                const orderDbId = button.getAttribute('data-order-db-id');
                const restaurantName = button.getAttribute('data-restaurant-name');

                document.getElementById('orderIdInModal').textContent = orderIdDisplay;
                document.getElementById('restaurantNameInModal').textContent = restaurantName;
                document.getElementById('modalOrderDbId').value = orderDbId;

                ratingForm.reset();
                updateStarDisplay(ratingForm.querySelector('.rating-stars'), 0); // Reset to 0 stars
            });

            // Handle star interaction in the modal (click)
            ratingForm.querySelectorAll('.rating-stars input[type="radio"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const selectedRating = parseInt(this.value);
                    updateStarDisplay(this.closest('.rating-stars'), selectedRating);
                });
            });

            // Handle star interaction in the modal (hover)
            ratingForm.querySelectorAll('.rating-stars label').forEach(label => {
                label.addEventListener('mouseover', function() {
                    const hoverRating = parseInt(this.previousElementSibling.value);
                    updateStarDisplay(this.closest('.rating-stars'), hoverRating);
                });

                label.addEventListener('mouseout', function() {
                    const currentSelected = ratingForm.querySelector(
                    'input[name="rating"]:checked');
                    const currentRating = currentSelected ? parseInt(currentSelected.value) : 0;
                    updateStarDisplay(this.closest('.rating-stars'), currentRating);
                });
            });

            // Submit rating via AJAX
            ratingForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const rating = document.querySelector('input[name="rating"]:checked');
                const review = document.getElementById('reviewText').value;
                const orderDbId = document.getElementById('modalOrderDbId').value;
                const orderIdDisplay = document.getElementById('orderIdInModal').textContent;
                const restaurantName = document.getElementById('restaurantNameInModal').textContent;

                if (!rating) {
                    alert('Please select a rating.');
                    return;
                }

                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('/api/ratings', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            order_id: orderDbId,
                            rating: rating.value,
                            review: review
                        })
                    })
                    .then(res => {
                        if (!res.ok) {
                            return res.json().then(errorData => {
                                throw new Error(errorData.message || 'Something went wrong.');
                            });
                        }
                        return res.json();
                    })
                    .then(data => {
                        alert(data.message);
                        const modal = bootstrap.Modal.getInstance(ratingModal);
                        modal.hide();

                        const orderCard = document.querySelector('.order-card[data-order-db-id="${orderDbId}"]');
                        if (orderCard) {
                            const rateBtn = orderCard.querySelector('.rate-now-btn');
                            if (rateBtn) {
                                rateBtn.textContent = 'Rated';
                                rateBtn.classList.remove('btn-success');
                                rateBtn.classList.add('btn-secondary');
                                rateBtn.disabled = true;
                            }

                            let ratingSection = orderCard.querySelector('.rating-section');
                            if (!ratingSection) {
                                ratingSection = document.createElement('div');
                                ratingSection.classList.add('rating-section', 'text-center');
                                orderCard.appendChild(ratingSection);
                            }

                            let starHtml = '';
                            for (let i = 5; i >= 1; i--) {
                                starHtml +=
                                    `<label class="${rating.value >= i ? 'active' : ''}">${rating.value >= i ? '★' : '☆'}</label>`;
                            }

                            ratingSection.innerHTML = `
                        <p class="mb-2">Your Rating for ${restaurantName}:</p>
                        <div class="rating-stars display-only">
                            ${starHtml}
                        </div>
                        ${review ? `<p class="mt-2 text-muted">"${review}"</p>` : ''}
                    `;
                        }
                    })
                    .catch(err => {
                        alert('Error: ' + err.message);
                    });
            });

            // Filter button click handler
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const filterType = this.dataset.filter;
                    const currentUrl = new URL(window.location.href);

                    if (filterType === 'all') {
                        currentUrl.searchParams.delete('filter');
                    } else {
                        currentUrl.searchParams.set('filter', filterType);
                    }

                    window.location.href = currentUrl.toString();
                });
            });
        });
    </script>
@endpush
