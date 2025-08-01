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
                            <button type="button" class="btn btn-success rate-now-btn" 
                                data-bs-toggle="modal"
                                data-bs-target="#ratingModal"
                                data-order-id="{{ $order->order_id }}"
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
                        <input type="hidden" id="modalOrderDbIdHidden" name="order_id">
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
    <script>
       document.querySelectorAll('.rate-now-btn').forEach(button => {
        button.addEventListener('click', function () {
            const restaurantName = button.dataset.restaurantName;
            const orderDisplayId = button.dataset.orderId;
            const orderDbId = button.dataset.orderDbId;


            document.getElementById('restaurantNameInModal').textContent = restaurantName;
            document.getElementById('orderIdInModal').textContent = orderDisplayId;

            document.getElementById('modalOrderDbIdHidden').value = orderDisplayId;
            document.getElementById('modalOrderIdDisplayHidden').value = orderDisplayId;
            document.getElementById('modalRestaurantNameDisplayHidden').value = restaurantName;

            document.querySelectorAll('input[name="rating"]').forEach(input => input.checked = false);
            document.getElementById('reviewText').value = '';

            const modal = new bootstrap.Modal(document.getElementById('ratingModal'));
            modal.show();
        });
    });

    const ratingForm = document.getElementById('ratingForm');
    ratingForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const rating = document.querySelector('input[name="rating"]:checked');
        const review = document.getElementById('reviewText').value;
        const orderId = document.getElementById('modalOrderDbIdHidden').value;

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
                order_id: orderId,
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
            const modalElement = document.getElementById('ratingModal');
            const modal = bootstrap.Modal.getInstance(modalElement);
            modal.hide();

            document.body.classList.remove('modal-open');
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            document.body.style.overflow = 'auto';
            document.body.style.paddingRight = '';

            setTimeout(() => {
                location.reload();
            }, 1000);
        })
        .catch(err => {
            alert('Error: ' + err.message);
        });
    });

    const ratingModalElement = document.getElementById('ratingModal');
    ratingModalElement.addEventListener('hidden.bs.modal', () => {
        document.body.classList.remove('modal-open');
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
        document.body.style.overflow = 'auto';
        document.body.style.paddingRight = '';
    });

    // Filter button click handler
    const filterButtons = document.querySelectorAll('.order-tabs button');
    filterButtons.forEach(button => {
        button.addEventListener('click', function () {
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
    

    </script>
@endpush
