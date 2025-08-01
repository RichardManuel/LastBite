@extends('store.layouts.app')

@section('title', 'Restaurant Orders')

@push('styles')
    {{-- Anda bisa memindahkannya ke file CSS eksternal jika mau --}}
    <style>
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            border-bottom: 0.5px solid #6c757d;
        }

        .order-header h2 {
            font-family: 'Instrument Serif', serif;
            font-size: 4rem;
            color: #212529;
            margin-top: 1rem;
        }

        .order-header p {
            font-size: 1.5rem;
            color: #6c757d;
        }

        .order-card {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .order-details-area {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            padding: 1rem;
        }

        .order-detail-item p {
            font-size: 1.2rem;
            color: #6c757d;
            margin-bottom: 0.25rem;
        }

        .order-detail-item strong {
            font-size: 1rem;
            color: #212529;
            font-weight: 600;
            font-family: 'Instrument Sans', sans-serif;
        }
        
        .order-actions-section {
            padding: 1rem;
            padding-top: 0;
            font-family: 'Instrument Sans', sans-serif;
        }

        .order-actions-section hr {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            font-family: 'Instrument Sans', sans-serif;
        }

         /* Base styling for all filter buttons */
        .order-tabs .btn-filter {
            border: 1px solid #dee2e6;
            border-radius: 1rem;
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: #6c757d;
            background-color: transparent;
            transition: all 0.3s ease;
            font-family: 'Instrument Sans', sans-serif;
            font-weight: 600;
            margin-right: 0.5rem;
            margin-top: 3rem;
        }

        /* Hover effect for all filter buttons */
        .order-tabs .btn-filter:hover {
            background-color: #e9ecef;
            color: #495057;
            border-color: #adb5bd;
        }

        /* Active state for all buttons */
        .order-tabs .btn-filter.active {
            background-color: #ffc107; /* Warna kuning dari desain */
            border-color: #ffc107;
            color: #000;
            font-weight: bold;
            font-family: 'Instrument Sans', sans-serif;
        }

    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="order-header">
            <div>
                <h2 class="mb-0">Restaurant Orders</h2>
                <p class="text-muted">Manage incoming and completed orders.</p>
            </div>
            <div class="order-tabs">
                <a href="{{ route('resto.orders.index') }}"
                    class="btn btn-filter {{ $status === null ? 'active' : '' }}">All</a>
                <a href="{{ route('resto.orders.index', ['status' => 'Ongoing']) }}"
                    class="btn btn-filter btn-warning-outline {{ $status === 'Ongoing' ? 'active' : '' }}">Ongoing</a>
                <a href="{{ route('resto.orders.index', ['status' => 'Completed']) }}"
                    class="btn btn-filter btn-success-outline {{ $status === 'Completed' ? 'active' : '' }}">Completed</a>
                <a href="{{ route('resto.orders.index', ['status' => 'Cancelled']) }}"
                    class="btn btn-filter btn-danger-outline {{ $status === 'Cancelled' ? 'active' : '' }}">Cancelled</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @forelse ($orders as $order)
            <div class="order-card">
                {{-- Order Details Section --}}
                <div class="order-details-area">
                    <div class="order-detail-item">
                        <p>Order ID</p>
                        <strong>#{{ $order->order_id }}</strong>
                    </div>
                    <div class="order-detail-item">
                        <p>Customer</p>
                        <strong>{{ $order->user->name ?? '-' }}</strong>
                    </div>
                    <div class="order-detail-item">
                        <p>Pickup Time</p>
                        <strong>{{ $order->pickup->time_type ?? '-' }}</strong>
                    </div>
                    <div class="order-detail-item">
                        <p>Payment</p>
                        <strong>{{ $order->payment_method ?? '-' }}</strong>
                    </div>
                    <div class="order-detail-item">
                        <p>Total</p>
                        <strong>Rp{{ number_format($order->item_price, 0, ',', '.') }}</strong>
                    </div>
                    <div class="order-detail-item">
                        <p>Status</p>
                        @if ($order->status === 'Completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif($order->status === 'Cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                        @else
                            <span class="badge bg-warning text-dark">Ongoing</span>
                        @endif
                    </div>
                </div>

                {{-- Action Section --}}
                <div class="order-actions-section">
                    <hr>
                    <div class="d-flex justify-content-end gap-2">
                        @if ($order->status === 'Ongoing')
                            <form action="{{ route('resto.orders.updateStatus', $order->order_id) }}" method="POST"
                                class="d-flex gap-2">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="action" value="Completed"
                                    class="btn btn-sm btn-success">Complete</button>
                                <button type="submit" name="action" value="Cancelled"
                                    class="btn btn-sm btn-danger">Cancel</button>
                            </form>
                        @else
                            <em class="text-muted">No action available</em>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center" role="alert">
                No orders found.
            </div>
        @endforelse
    </div>
@endsection