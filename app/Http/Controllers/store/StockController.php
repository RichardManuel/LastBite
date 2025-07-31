<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RestaurantStock;
use App\Models\Restaurant;

class StockController extends Controller
{
    // Menampilkan halaman manage stock untuk restoran yang login
    public function manageStock()
    {
        $restaurant = Auth::guard('resto')->user()->load('stocks');

        $stockLunch = $restaurant->stocks
            ->where('pickup_time', 'Lunch')
            ->first()?->stock ?? 0;

        $stockDinner = $restaurant->stocks
            ->where('pickup_time', 'Dinner')
            ->first()?->stock ?? 0;

        return view('store.stock', compact('restaurant', 'stockLunch', 'stockDinner'));
    }

    // Ambil stok berdasarkan pickup_time
    public function fetchStock(Request $request)
    {
        $restaurant = Auth::guard('resto')->user();
        $pickupTime = $request->query('pickup_time', 'Lunch');

        $stock = $restaurant->stocks()
            ->where('item_name', $restaurant->name)
            ->where('pickup_time', $pickupTime)
            ->first();

        return response()->json([
            'stock' => $stock?->stock ?? 0
        ]);
    }

    // Update stok sesuai aksi add/remove
    public function updateStock(Request $request)
    {
        $restaurant = Auth::guard('resto')->user();
        $itemName = $restaurant->name;

        $validated = $request->validate([
            'pickup_time' => 'required|in:Lunch,Dinner',
            'quantity' => 'required|integer|min:1',
            'action' => 'required|in:add,remove'
        ]);

        $stock = $restaurant->stocks()
            ->where('item_name', $itemName)
            ->where('pickup_time', $validated['pickup_time'])
            ->first();

        if (!$stock) {
            $stock = new RestaurantStock([
                'restaurant_id' => $restaurant->restaurant_id,
                'item_name' => $itemName,
                'pickup_time' => $validated['pickup_time'],
                'stock' => 0,
            ]);
        }

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
