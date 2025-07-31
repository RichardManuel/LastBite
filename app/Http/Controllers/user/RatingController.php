<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Restaurant;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        // Gunakan user dari auth default
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.'
            ], 401);
        }

        // Validasi input
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,order_id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $order = Order::where('order_id', $validated['order_id'])->firstOrFail();

        // Pastikan order dimiliki oleh user ini
        if ($order->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'This order does not belong to you.'
            ], 403);
        }

        // Hanya order yang "Completed" bisa dirating
        if ($order->status !== 'Completed') {
            return response()->json([
                'success' => false,
                'message' => 'Only completed orders can be rated.'
            ], 400);
        }

        // Cegah duplikasi rating
        if (Rating::where('order_id', $order->order_id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'You have already rated this order.'
            ], 409);
        }

        // Simpan rating
        $newRating = Rating::create([
            'user_id' => $user->id,
            'order_id' => $order->order_id,
            'restaurant_id' => $order->restaurant_id,
            'rating' => $validated['rating'],
            'review' => $validated['review'],
        ]);

        // Update rating di restoran
        $restaurant = Restaurant::where('restaurant_id', $order->restaurant_id)->first();
        if ($restaurant) {
            $totalRatings = Rating::where('restaurant_id', $restaurant->restaurant_id)->count();
            $sumRatings = Rating::where('restaurant_id', $restaurant->restaurant_id)->sum('rating');

            $restaurant->ratings_count = $totalRatings;
            $restaurant->avg_rating = $totalRatings > 0 ? round($sumRatings / $totalRatings, 1) : 0.0;
            $restaurant->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Rating submitted successfully.'
        ]);
    }
}
