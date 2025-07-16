<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantManagementController extends Controller
{
    /**
     * Menampilkan daftar restoran dengan status 'pending_approval'
     */
    public function showPage()
    {
        $restaurants = Restaurant::where('status', 'pending_approval')
            ->latest()
            ->get();

        return view('admin.resto-application', [
            'restaurants' => $restaurants
        ]);
    }

    /**
     * Menerima restoran
     */
    public function accept(Restaurant $restaurant)
    {
        if ($restaurant->status !== 'pending_approval') {
            return redirect()->back()->with('error', 'This restaurant has already been processed.');
        }

        $restaurant->update(['status' => 'accepted']);

        return redirect()->back()->with('success', 'Restaurant has been accepted.');
    }

    /**
     * Menolak restoran
     */
    public function decline(Restaurant $restaurant)
    {
        if ($restaurant->status !== 'pending_approval') {
            return redirect()->back()->with('error', 'This restaurant has already been processed.');
        }

        $restaurant->update(['status' => 'declined']);

        return redirect()->back()->with('success', 'Restaurant has been declined.');
    }
}
