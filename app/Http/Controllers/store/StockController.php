<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RestaurantStock;
use App\Models\Restaurant;

class StockController extends Controller
{
    // Halaman Manage Stock
    public function manageStock($restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);

        // default ambil stok Lunch untuk Dunkin Doughnut
        $itemName = 'Dunkin Doughnut';
        $stockLunch = RestaurantStock::where('restaurant_id', $restaurantId)
            ->where('item_name', $itemName)
            ->where('pickup_time', 'Lunch')
            ->first();

        return view('store.stock', [
            'restaurant' => $restaurant,
            'itemName' => $itemName,
            'stockLunch' => $stockLunch ? $stockLunch->stock : 0,
        ]);
    }

    // Ambil stok sesuai pickup_time
    public function fetchStock(Request $request, $restaurantId)
    {
        $pickupTime = $request->query('pickup_time', 'Lunch');
        $itemName = $request->query('item_name');

        $stock = RestaurantStock::where('restaurant_id', $restaurantId)
            ->where('item_name', $itemName)
            ->where('pickup_time', $pickupTime)
            ->first();

        return response()->json([
            'stock' => $stock ? $stock->stock : 0
        ]);
    }

    // Update stok (add/remove)
    public function updateStock(Request $request, $restaurantId)
    {
        $validated = $request->validate([
            'item_name' => 'required|string',
            'pickup_time' => 'required|in:Lunch,Dinner',
            'quantity' => 'required|integer|min:1',
            'action' => 'required|in:add,remove'
        ]);

        $stock = RestaurantStock::firstOrCreate([
            'restaurant_id' => $restaurantId,
            'item_name' => $validated['item_name'],
            'pickup_time' => $validated['pickup_time']
        ]);

        if ($validated['action'] === 'add') {
            $stock->stock += $validated['quantity'];
        } else {
            $stock->stock = max(0, $stock->stock - $validated['quantity']);
        }

        $stock->save();

        return response()->json([
            'success' => true,
            'stock' => $stock->stock
        ]);
    }
}
