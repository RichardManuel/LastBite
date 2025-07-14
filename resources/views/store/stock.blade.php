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
<div class="container my-5">
    <div class="row">
        <!-- Income Section -->
        <div class="col-md-6 mb-4">
            <div class="p-4 bg-cream border rounded">
                <h4>Income</h4>
                <h2 class="fw-bold mt-2">Rp 350.000,00</h2>
            </div>

            <div class="mt-3 p-4 bg-cream border rounded">
                <h5>Breakdown</h5>
                <ul class="list-unstyled mt-2">
                    <li>- Today: Rp 50.000,00</li>
                    <li>- This Week: Rp 150.000,00</li>
                    <li>- This Month: Rp 350.000,00</li>
                </ul>
            </div>
        </div>

        <!-- Manage Stock Section -->
        <div class="col-md-6">
            <div class="p-4 bg-cream border rounded">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="mb-0">Manage Stock</h4>
                    <ul class="nav nav-tabs custom-tab-bar" id="stockTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="lunch-tab" data-bs-toggle="tab" data-bs-target="#lunch" type="button" role="tab">
                                Lunch
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="dinner-tab" data-bs-toggle="tab" data-bs-target="#dinner" type="button" role="tab">
                                Dinner
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content" id="stockTabContent">
                    <!-- Lunch Tab Content -->
                    <div class="tab-pane fade show active" id="lunch" role="tabpanel">
                        <h5>Lunch</h5>
                        <div class="d-flex justify-content-between align-items-start flex-wrap mt-3">
                            <!-- Left Side: Item Details -->
                            <div class="me-4">
                                <p class="mb-1 fw-bold">Item Name</p>
                                <p>Dunkin Doughnut</p>

                                <p class="mb-1 fw-bold">Category</p>
                                <p>Bread & Salad</p>

                                <p class="mb-1 fw-bold">Current Stock</p>
                                <p>{{ $stock }}</p>
                            </div>

                            <!-- Right Side: Form -->
                            <form method="POST" action="/stocks/update" class="flex-grow-1">
                                @csrf
                                <p class="mb-1 fw-bold">Add Stock</p>
                                <div class="stock-form-group">
                                    <label for="addQty">Quantity to Add</label>
                                    <input type="number" name="addQty" id="addQty" value="0" class="form-control">
                                    <button type="submit" name="action" value="add" class="btn btn-warning mt-2">Add</button>
                                </div>

                                <p class="mb-1 fw-bold">Remove Stock</p>
                                <div class="stock-form-group">
                                    <label for="removeQty">Quantity to Remove</label>
                                    <input type="number" name="removeQty" id="removeQty" value="0" class="form-control">
                                    <button type="submit" name="action" value="remove" class="btn btn-warning mt-2">Remove</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Dinner Tab Content -->
                    <div class="tab-pane fade" id="dinner" role="tabpanel">
                        <h5>Dinner</h5>
                        <div class="d-flex justify-content-between align-items-start flex-wrap mt-3">
                            <!-- Left Side: Item Details -->
                            <div class="me-4">
                                <p class="mb-1 fw-bold">Item Name</p>
                                <p>Dunkin Doughnut</p>

                                <p class="mb-1 fw-bold">Category</p>
                                <p>Bread & Salad</p>

                                <p class="mb-1 fw-bold">Current Stock</p>
                                <p>{{ $stock }}</p>
                            </div>

                            <!-- Right Side: Form -->
                            <form method="POST" action="/stocks/update" class="flex-grow-1">
                                @csrf
                                <p class="mb-1 fw-bold">Add Stock</p>
                                <div class="stock-form-group">
                                    <label for="addQtyDinner">Quantity to Add</label>
                                    <input type="number" name="addQty" id="addQtyDinner" value="0" class="form-control">
                                    <button type="submit" name="action" value="add" class="btn btn-warning mt-2">Add</button>
                                </div>

                                <p class="mb-1 fw-bold">Remove Stock</p>
                                <div class="stock-form-group">
                                    <label for="removeQtyDinner">Quantity to Remove</label>
                                    <input type="number" name="removeQty" id="removeQtyDinner" value="0" class="form-control">
                                    <button type="submit" name="action" value="remove" class="btn btn-warning mt-2">Remove</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
