<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

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

        if ($order->restaurant_id !== $restaurant->restaurant_id) {
            abort(403);
        }

        $action = $request->input('action');

        if ($action === 'Completed') {
            $pickupTime = $order->pickup->pickup_time ?? null;

            if ($pickupTime) {
                $stock = $restaurant->stocks()->where('pickup_time', $pickupTime)->first();

                if (!$stock || $stock->stock <= 0) {
                    return redirect()->back()->with('error', 'Stock for ' . $pickupTime . ' is empty. Cannot complete the order.');
                }

                $stock->stock -= 1;
                $stock->save();
            }

            $order->status = 'Completed';

        } elseif ($action === 'Cancelled') {
            $order->status = 'Cancelled';
        }

        $order->save();

        return redirect()->route('resto.orders.index')->with('success', 'Order status updated.');
    }
}
