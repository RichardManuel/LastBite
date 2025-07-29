<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('restaurant')
            ->latest()
            ->get();

        return view('user.orderuser', compact('orders'));
    }

    public function show($orderId)
    {
        $order = Order::with('restaurant')->where('user_id', auth()->id())->find($orderId);

        if (!$order) {
            abort(404, 'Order tidak ditemukan.');
        }

        // Tambahkan summary kalau perlu
        $summary = $this->generateSummary($order); // opsional kalau kamu ada logic-nya

        return view('user.review', compact('order', 'summary'));
    }
}