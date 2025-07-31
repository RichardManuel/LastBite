<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user(); // Asumsi guard default
        if (!$user) {
            $user = \App\Models\User::first(); // Fallback
        }

        $ordersQuery = Order::where('user_id', $user->id)
            ->with(['restaurant', 'rating']) // pastikan relasi dimuat
            ->orderBy('created_at', 'desc');

        // Ambil filter dari query parameter
        $filter = $request->query('filter', 'all');

        switch ($filter) {
            case 'ongoing':
                $ordersQuery->where('status', 'Ongoing');
                break;
            case 'completed':
                $ordersQuery->where('status', 'Completed');
                break;
            case 'cancelled':
                $ordersQuery->where('status', 'Cancelled');
                break;
            case 'rated':
                $ordersQuery->whereHas('rating');
                break;
            case 'all':
            default:
                // Tidak ada filter
                break;
        }


        $orders = $ordersQuery->get();

        return view('user.orderuser', compact('orders', 'filter'));
    }

    public function show($id)
    {
        $user = Auth::guard('user')->user();
        if (!$user) {
            $user = \App\Models\User::first(); // Fallback for testing
        }

        $order = Order::where('id', $id)
                      ->where('user_id', $user->id)
                      ->with(['restaurant', 'pickup', 'rating'])
                      ->firstOrFail();

        return view('user.order_details', compact('order'));
    }

}