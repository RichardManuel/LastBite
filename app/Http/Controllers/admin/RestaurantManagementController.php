<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantManagementController extends Controller
{
    public function showPage()
    {
        $restaurants = Restaurant::all();
        return view('admin.resto-management', compact('restaurants'));
    }

    public function suspend($restaurant_id)
    {
        $restaurant = Restaurant::where('restaurant_id', $restaurant_id->restaurant_id)->first();

        if (!$restaurant) {
            return redirect()->route('admin.management.index')->with('error', 'Restaurant not found.');
        }

        if ($restaurant->status !== 'suspended') {
            $restaurant->status = 'suspended';
            $restaurant->save();
            return redirect()->route('admin.management.index')->with('success', 'Restaurant has been suspended successfully.');
        }

        return redirect()->route('admin.management.index')->with('info', 'Restaurant is already suspended.');
    }

    public function unsuspend($restaurant_id)
    {
        $restaurant = Restaurant::where('restaurant_id', $restaurant_id->restaurant_id)->first();

        if (!$restaurant) {
            return redirect()->route('admin.management.index')->with('error', 'Restaurant not found.');
        }

        if ($restaurant->status === 'suspended') {
            $restaurant->status = 'accepted';
            $restaurant->save();
            return redirect()->route('admin.management.index')->with('success', 'Restaurant has been unsuspended successfully.');
        }

        return redirect()->route('admin.management.index')->with('info', 'Restaurant is not suspended.');
    }

    public function destroy($restaurant_id)
    {
        $restaurant = Restaurant::where('restaurant_id', $restaurant_id)->first();

        if (!$restaurant) {
            return redirect()->route('admin.management.index')->with('error', 'Restaurant not found.');
        }

        $restaurant->delete();
        return redirect()->route('admin.management.index')->with('success', 'Restaurant has been deleted.');
    }
}
