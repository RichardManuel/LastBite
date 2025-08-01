<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RestaurantStock;
use App\Models\Restaurant;
use App\Models\Order; // Pastikan model Order diimpor

class StockController extends Controller
{
    // Menampilkan halaman manage stock untuk restoran yang login
    public function manageStock()
    {
        $restaurant = Auth::guard('resto')->user()->load('stocks');
        
        // --- LOGIKA BARU UNTUK PENDAPATAN ---
        // Ambil semua order yang berstatus 'Completed' untuk restoran ini
        $completedOrders = Order::where('restaurant_id', $restaurant->restaurant_id)
            ->where('status', 'Completed')
            ->latest() // Urutkan dari yang terbaru
            ->get();
            
        // Hitung total pendapatan
        $totalIncome = $completedOrders->sum('item_price');
        
        // Hitung breakdown pendapatan
        $dailyIncome = $completedOrders->where('updated_at', '>=', now()->startOfDay())->sum('item_price');
        $weeklyIncome = $completedOrders->where('updated_at', '>=', now()->subWeek())->sum('item_price');
        $monthlyIncome = $completedOrders->where('updated_at', '>=', now()->startOfMonth())->sum('item_price');

        // --- END LOGIKA BARU ---
        
        $stockLunch = $restaurant->stocks
            ->where('pickup_time', 'Lunch')
            ->first()?->stock ?? 0;

        $stockDinner = $restaurant->stocks
            ->where('pickup_time', 'Dinner')
            ->first()?->stock ?? 0;

        // Kirim data baru ke view
        return view('store.stock', compact('restaurant', 'stockLunch', 'stockDinner', 'totalIncome', 'dailyIncome', 'weeklyIncome', 'monthlyIncome', 'completedOrders'));
    }

    // ... (metode fetchStock dan updateStock tidak perlu diubah) ...
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