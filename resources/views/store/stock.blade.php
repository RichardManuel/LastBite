@extends('store.layouts.app')

@section('title', 'Stocks')

@push('styles')
    <link href="/css/stocks.css" rel="stylesheet">
    <style>
        .bg-cream {
            background-color: #FAF7F2;
        }

        .stock-form-group {
            margin-bottom: 1rem;
        }

        .btn-toggle {
            width: 100px;
        }

        .btn-toggle.active {
            font-weight: bold;
            border: 2px solid #000;
        }
    </style>
@endpush

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container">
        <h3>Manage Stock</h3>

        {{-- Toggle Lunch/Dinner --}}
        <div>
            <button id="btnLunch" type="button" class="btn btn-toggle btn-warning active" onclick="toggleStock('Lunch')">Lunch</button>
            <button id="btnDinner" type="button" class="btn btn-toggle btn-light" onclick="toggleStock('Dinner')">Dinner</button>
        </div>

        <div class="mt-4">
            <div class="stock-form-group">
                <label>Restaurant Name:</label>
                <input type="text" class="form-control w-50" value="{{ $restaurant->name }}" disabled>
            </div>

            {{-- Stock info --}}
            <p>Current Stock (<span id="current-pickup-label">Lunch</span>):
                <span id="stock-count">{{ $stockLunch ?? 0 }}</span>
            </p>

            {{-- Stock Controls --}}
            <div class="d-flex">
                <input type="number" id="quantity" class="form-control w-25" placeholder="Qty" min="1">
                <button type="button" class="btn btn-success ms-2" onclick="updateStock('add')">Add</button>
                <button type="button" class="btn btn-danger ms-2" onclick="updateStock('remove')">Remove</button>
            </div>
        </div>
    </div>

    <script>
        let currentPickup = 'Lunch';
        let restaurantId = '{{ $restaurant->restaurant_id }}';
        let stockLunch = {{ $stockLunch ?? 0 }};
        let stockDinner = {{ $stockDinner ?? 0 }};
        let itemName = '{{ $restaurant->name }}';

        function toggleStock(pickup) {
            currentPickup = pickup;
            document.getElementById('current-pickup-label').innerText = pickup;

            if (pickup === 'Lunch') {
                document.getElementById('stock-count').innerText = stockLunch;
                document.getElementById('btnLunch').classList.add('active', 'btn-warning');
                document.getElementById('btnLunch').classList.remove('btn-light');
                document.getElementById('btnDinner').classList.remove('active', 'btn-warning');
                document.getElementById('btnDinner').classList.add('btn-light');
            } else {
                document.getElementById('stock-count').innerText = stockDinner;
                document.getElementById('btnDinner').classList.add('active', 'btn-warning');
                document.getElementById('btnDinner').classList.remove('btn-light');
                document.getElementById('btnLunch').classList.remove('active', 'btn-warning');
                document.getElementById('btnLunch').classList.add('btn-light');
            }
        }

        function updateStock(action) {
            const qty = parseInt(document.getElementById('quantity').value);
            if (!qty || qty <= 0) {
                alert("Please enter a valid quantity.");
                return;
            }

            fetch(`{{ route('resto.stock.update') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    item_name: itemName,
                    pickup_time: currentPickup,
                    quantity: qty,
                    action: action
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (currentPickup === 'Lunch') {
                        stockLunch = data.stock;
                    } else {
                        stockDinner = data.stock;
                    }
                    document.getElementById('stock-count').innerText = data.stock;
                    document.getElementById('quantity').value = '';
                } else {
                    alert(data.message || "Update failed.");
                }
            })
            .catch(err => {
                console.error('Error updating stock:', err);
                alert("Failed to update stock.");
            });
        }
    </script>
@endsection
