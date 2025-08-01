{{-- resources/views/store/stocks.blade.php --}}
@extends('store.layouts.app')

@section('title', 'Stocks')

@push('styles')
    <link href="/css/stocks.css" rel="stylesheet">
    <style>
        .bg-cream {
            background-color: #FAF7F2;
            color: #000;
        }

        .card-custom {
            background-color: #FAF7F2;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .stock-form-group {
            margin-bottom: 1rem;
        }

        .btn-toggle {
            width: 100px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            cursor: pointer;
        }

        .btn-toggle.active {
            font-weight: bold;
            border: 2px solid #000;
        }

        .font-instrument-serif {
            font-family: 'Instrument Serif', serif;
        }

        .income-title {
            font-family: 'Instrument Serif', serif;
            font-size: 2rem;
            color: #474747;
        }

        .income-total {
            font-size: 3rem;
            font-weight: bold;
            font-family: 'Instrument Sans', sans-serif;
            color: #474747;
        }
        
        .income-breakdown-list {
            max-height: 200px;
            overflow-y: auto;
            list-style: none;
            font-family: 'Instrument Sans', sans-serif;
            font-weight: 500;
            padding-left: 0;
            color: #474747;
        }

        .income-breakdown-list li {
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }

        .manage-stock-title {
            font-family: 'Instrument Serif', serif;
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #474747;
        }

        .form-label-custom {
            font-weight: bold;
            margin-bottom: 0.25rem;
            color: #474747;
            font-family: 'Instrument Serif', serif;
            font-size: 1.4rem;
            font-weight: 700;
        }

        .form-input-custom {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            color: #474747;

        }

        .stock-form-group p {
            font-weight: bold;
            color: #474747;
            font-family: 'Instrument Sans', sans-serif;
        }

        .btn-custom {
            padding: 8px 15px;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease; /* Tambahkan transisi untuk efek hover yang halus */
        }
        
        /* Mengubah font size dan menambahkan efek hover */
        .btn-add {
            background-color: #ffc107;
            color: #000;
            border: none;
            font-weight: 700;
            font-size: 16px; /* Font size dikecilkan */
            font-family: 'Instrument Sans', sans-serif;
        }
        
        .btn-add:hover {
            background-color: #e0b000; /* Warna hover yang lebih gelap */
            color: #000;
        }

        /* Mengubah font size dan menambahkan efek hover */
        .btn-remove {
            background-color: #ffc107;
            color: #474747;
            border: none;
            font-weight: 700;
            font-size: 16px; /* Font size dikecilkan */
            font-family: 'Instrument Sans', sans-serif;
        }
        
        .btn-remove:hover {
            background-color: #e0b000; /* Warna hover yang lebih gelap */
            color: #474747;
        }

        .btn-category-toggle {
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 5px;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #000 ;
            
        }

        .btn-category-toggle:hover {
            background-color: #ffc107;
            border-color: #a0a0a0; 
        }

        .btn-category-toggle.active {
            background-color: #ffc107;
            border-color: #ffc107;
            font-weight: bold;
        }

        .btn-category-toggle.active:hover {
            background-color: #e0b000;
            border-color: #e0b000;
        }
    </style>
@endpush

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container mt-5">
        <div class="row">
            {{-- Income and Breakdown Section (Left Column) --}}
            <div class="col-md-4">
                {{-- Income Card --}}
                <div class="card-custom mb-4">
                    <h5 class="income-title">Income</h5>
                    <small>Total</small>
                    <div class="income-total">Rp {{ number_format($totalIncome, 2, ',', '.') }}</div>
                </div>

                {{-- Breakdown Card --}}
                <div class="card-custom">
                    <h5 class="income-title">Breakdown</h5>
                    <ul class="income-breakdown-list">
                        @forelse($completedOrders as $order)
                            <li>Order ID: {{ $order->order_id }} - Rp {{ number_format($order->item_price, 2, ',', '.') }}</li>
                        @empty
                            <li>No completed orders yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- Manage Stock Section (Right Column) --}}
            <div class="col-md-8">
                <div class="card-custom">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="manage-stock-title">Manage Stock</h5>
                        <div>
                            <button id="btnLunch" type="button" class="btn btn-toggle btn-category-toggle active"
                                onclick="toggleStock('Lunch')">Lunch</button>
                            <button id="btnDinner" type="button" class="btn btn-toggle btn-category-toggle"
                                onclick="toggleStock('Dinner')">Dinner</button>
                        </div>
                    </div>

                    <div class="stock-form-group">
                        <label class="form-label-custom">Item Name</label>
                        <p class="mb-1 font-weight-bold">{{ $restaurant->name }}</p>
                    </div>

                    <div class="stock-form-group">
                        <label class="form-label-custom">Category</label>
                        <p class="mb-1 font-weight-bold">{{ $restaurant->food_type }}</p>
                    </div>

                    <div class="stock-form-group">
                        <label class="form-label-custom">Current Stock</label>
                        <p class="mb-1 font-weight-bold" id="stock-count">{{ $stockLunch ?? 0 }}</p>
                    </div>

                    <hr>

                    {{-- Add Stock --}}
                    <div class="stock-form-group d-flex align-items-center">
                        <label class="form-label-custom me-2">Quantity to Add</label>
                        <input type="number" id="add-quantity" class="form-control form-input-custom w-25 me-2"
                            placeholder="Qty" min="1">
                        <button type="button" class="btn btn-add btn-custom" onclick="updateStock('add')">Add</button>
                    </div>

                    {{-- Remove Stock --}}
                    <div class="stock-form-group d-flex align-items-center">
                        <label class="form-label-custom me-2">Quantity to Remove</label>
                        <input type="number" id="remove-quantity" class="form-control form-input-custom w-25 me-2"
                            placeholder="Qty" min="1">
                        <button type="button" class="btn btn-remove btn-custom"
                            onclick="updateStock('remove')">Remove</button>
                    </div>
                </div>
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
            if (pickup === 'Lunch') {
                document.getElementById('stock-count').innerText = stockLunch;
                document.getElementById('btnLunch').classList.add('active');
                document.getElementById('btnDinner').classList.remove('active');
            } else {
                document.getElementById('stock-count').innerText = stockDinner;
                document.getElementById('btnDinner').classList.add('active');
                document.getElementById('btnLunch').classList.remove('active');
            }
        }

        function updateStock(action) {
            const quantityInputId = action === 'add' ? 'add-quantity' : 'remove-quantity';
            const qty = parseInt(document.getElementById(quantityInputId).value);

            if (isNaN(qty) || qty <= 0) {
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
                        document.getElementById(quantityInputId).value = '';
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