<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        // contoh data dummy
        $income = 350000;
        $breakdown = [
            'today' => 50000,
            'week' => 150000,
            'month' => 350000
        ];
        $item = [
            'name' => 'Dunkin Doughnut',
            'category' => 'Bread & Salad',
            'stock' => 3
        ];

        return view('store.stock', compact('income', 'breakdown', 'item'));
    }

    public function addStock(Request $request)
    {
        return back()->with('success', 'Stock added.');
    }

    public function removeStock(Request $request)
    {
        return back()->with('success', 'Stock removed.');
    }
}
