<?php
namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    private $stock = 3; // Example default value, replace with DB query if needed

    public function index()
    {
        return view('store.stock', ['stock' => $this->stock]);
    }

    public function update(Request $request)
    {
        $stock = 3; // Normally you'd fetch this from DB

        if ($request->action === 'add') {
            $stock += (int) $request->input('addQty');
        } elseif ($request->action === 'remove') {
            $stock -= (int) $request->input('removeQty');
            if ($stock < 0) $stock = 0;
        }

        // Optionally save to DB here

        return view('store.stock', ['stock' => $stock]);
    }
}
