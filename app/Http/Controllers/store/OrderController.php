<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\RestaurantStock; // Pastikan model ini diimpor

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $restaurant = Auth::guard('resto')->user();
        $status = $request->query('status');

        $ordersQuery = $restaurant->orders()->with(['user', 'pickup'])->latest();

        if (in_array($status, ['Ongoing', 'Completed', 'Cancelled'])) {
            $ordersQuery->where('status', $status);
        }

        $orders = $ordersQuery->get();

        return view('store.order', compact('orders', 'status'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $restaurant = Auth::guard('resto')->user();

        // Pastikan restoran yang login memiliki order ini
        if ($order->restaurant_id !== $restaurant->restaurant_id) {
            abort(403, 'Unauthorized action.');
        }

        $action = $request->input('action');
        
        // Cek apakah status order sudah 'Completed', untuk mencegah duplikasi
        if ($order->status === 'Completed' && $action === 'Completed') {
            return redirect()->back()->with('error', 'Order is already completed.');
        }

        if ($action === 'Completed') {
            // Ambil waktu pickup dari relasi
            $pickupTime = $order->pickup->time_type ?? null;

            if ($pickupTime) {
                // Temukan stok yang sesuai berdasarkan waktu pickup
                $stock = $restaurant->stocks()->where('pickup_time', $pickupTime)->first();
                
                // Cek apakah stok ada dan jumlahnya lebih dari 0
                if (!$stock || $stock->stock <= 0) {
                    return redirect()->back()->with('error', 'Stok untuk ' . $pickupTime . ' kosong. Tidak dapat menyelesaikan pesanan.');
                }
                
                // Kurangi stok sebanyak 1
                $stock->stock -= 1;
                $stock->save();
            }

            $order->status = 'Completed';
            
        } elseif ($action === 'Cancelled') {
            
            // Logika opsional: Jika order yang Ongoing dibatalkan,
            // stok yang sebelumnya mungkin sudah berkurang perlu dikembalikan.
            // Anda bisa tambahkan logika ini jika diperlukan.
            
            $order->status = 'Cancelled';
        }

        $order->save();

        return redirect()->route('resto.orders.index')->with('success', 'Order status updated.');
    }
}