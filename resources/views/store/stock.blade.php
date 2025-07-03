@extends('store.layout.app')

@section('title', 'Stocks')

@section('content')
<div class="flex flex-col md:flex-row gap-6 p-6">
    <div class="bg-yellow-50 p-6 rounded border w-full md:w-1/3">
        <h2 class="text-2xl font-serif mb-2">Income</h2>
        <p>Total</p>
        <p class="text-3xl font-bold">Rp {{ number_format($income, 2, ',', '.') }}</p>
    </div>
    <div class="bg-yellow-50 p-6 rounded border w-full md:w-1/3">
        <h2 class="text-2xl font-serif mb-2">Breakdown</h2>
        <ul class="text-sm">
            <li>- Today: Rp {{ number_format($breakdown['today'], 2, ',', '.') }}</li>
            <li>- This Week: Rp {{ number_format($breakdown['week'], 2, ',', '.') }}</li>
            <li>- This Month: Rp {{ number_format($breakdown['month'], 2, ',', '.') }}</li>
        </ul>
    </div>
    <div class="bg-yellow-50 p-6 rounded border w-full md:w-1/3">
        <h2 class="text-2xl font-serif mb-4">Manage Stock</h2>
        <p><strong>Item Name</strong><br>{{ $item['name'] }}</p>
        <p class="mt-2"><strong>Category</strong><br>{{ $item['category'] }}</p>
        <p class="mt-2"><strong>Current Stock</strong><br>{{ $item['stock'] }}</p>

        <form method="POST" action="{{ route('stocks.add') }}" class="mt-4 flex items-center space-x-2">
            @csrf
            <input type="number" name="quantity" value="1" min="1" class="border p-2 w-16">
            <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded">Add</button>
        </form>

        <form method="POST" action="{{ route('stocks.remove') }}" class="mt-2 flex items-center space-x-2">
            @csrf
            <input type="number" name="quantity" value="1" min="1" class="border p-2 w-16">
            <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded">Remove</button>
        </form>
    </div>
</div>
@endsection
