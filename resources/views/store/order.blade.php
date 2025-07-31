@extends('store.layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Restaurant Orders</h2>

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

        <div class="mb-3 d-flex gap-2">
            <a href="{{ route('resto.orders.index') }}"
                class="btn btn-outline-secondary {{ $status === null ? 'active' : '' }}">All</a>
            <a href="{{ route('resto.orders.index', ['status' => 'Ongoing']) }}"
                class="btn btn-outline-warning {{ $status === 'Ongoing' ? 'active' : '' }}">Ongoing</a>
            <a href="{{ route('resto.orders.index', ['status' => 'Completed']) }}"
                class="btn btn-outline-success {{ $status === 'Completed' ? 'active' : '' }}">Completed</a>
            <a href="{{ route('resto.orders.index', ['status' => 'Cancelled']) }}"
                class="btn btn-outline-danger {{ $status === 'Cancelled' ? 'active' : '' }}">Cancelled</a>
        </div>


        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Pickup Time</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->user->name ?? '-' }}</td>
                        <td>{{ $order->pickup->time_type ?? '-' }}</td>
                        <td>{{ $order->payment_method ?? '-' }}</td>
                        <td>
                            @if ($order->status === 'Completed')
                                <span class="badge bg-success">Completed</span>
                            @elseif($order->status === 'Cancelled')
                                <span class="badge bg-danger">Cancelled</span>
                            @else
                                <span class="badge bg-warning text-dark">Ongoing</span>
                            @endif
                        </td>
                        <td>Rp{{ number_format($order->item_price, 0, ',', '.') }}</td>
                        <td>
                            @if ($order->status === 'Ongoing')
                                <form action="{{ route('resto.orders.updateStatus', $order->order_id) }}" method="POST"
                                    class="d-flex gap-1">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="action" value="Completed"
                                        class="btn btn-sm btn-success">Complete</button>
                                    <button type="submit" name="action" value="Cancelled"
                                        class="btn btn-sm btn-danger">Cancel</button>
                                </form>
                            @else
                                <em class="text-muted">No action</em>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
