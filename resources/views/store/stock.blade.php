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
</style>
@endpush

@section('content')
<div class="container">
    <h3>Manage Stock</h3>

    {{-- Tombol toggle Lunch/Dinner --}}
    <div>
        <button class="btn btn-sm btn-warning" onclick="switchPickup('Lunch')">Lunch</button>
        <button class="btn btn-sm btn-outline-warning" onclick="switchPickup('Dinner')">Dinner</button>
    </div>

    <div class="mt-3">
        <h5>Item: <span id="item-name">Dunkin Doughnut</span></h5>
        <p>Current Stock (<span id="current-pickup">Lunch</span>): <span id="stock-count">{{ $stockLunch }}</span></p>

        <div class="d-flex">
            <input type="number" id="quantity" class="form-control w-25" placeholder="Qty">
            <button class="btn btn-success ms-2" onclick="updateStock('add')">Add</button>
            <button class="btn btn-danger ms-2" onclick="updateStock('remove')">Remove</button>
        </div>
    </div>
</div>

<script>
let currentPickup = 'Lunch';
let itemName = 'Dunkin Doughnut';
let restaurantId = '{{ $restaurant->restaurant_id }}';

function switchPickup(pickup) {
    currentPickup = pickup;
    document.getElementById('current-pickup').innerText = pickup;

    fetch(`/restaurant/${restaurantId}/stock?pickup_time=` + pickup + '&item_name=' + encodeURIComponent(itemName))
        .then(res => res.json())
        .then(data => {
            document.getElementById('stock-count').innerText = data.stock;
        });
}

function updateStock(action) {
    let qty = document.getElementById('quantity').value;

    fetch(`/restaurant/${restaurantId}/stock/update`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            item_name: itemName,
            pickup_time: currentPickup,
            quantity: parseInt(qty),
            action: action
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById('stock-count').innerText = data.stock;
            document.getElementById('quantity').value = '';
        }
    });
}
</script>
@endsection
