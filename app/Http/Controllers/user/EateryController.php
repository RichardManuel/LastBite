<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\RestaurantStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class EateryController extends Controller
{
    public function showPage(Request $request)
    {
        $query = Restaurant::query();

        // ===========================================
        // LANGKAH 1: TERAPKAN SEMUA FILTER (WHERE clauses)
        // ===========================================

        // --- LOGIKA PENCARIAN (SEARCH) ---
        if ($request->filled('query')) {
            $searchQuery = strtolower($request->query('query'));

            $query->where(function ($q) use ($searchQuery) {
                $q->where(DB::raw('LOWER(name)'), 'LIKE', "%{$searchQuery}%")
                  ->orWhere(DB::raw('LOWER(food_type)'), 'LIKE', "%{$searchQuery}%");
            });
        }

        // search lokasi
        if ($request->filled('location')) {
            $locationQuery = strtolower($request->query('location'));
            $query->where(DB::raw('LOWER(location)'), 'LIKE', "%{$locationQuery}%");
        }

        // --- LOGIKA FILTER (LUNCH/DINNER) ---
        if ($request->has('filter')) {
            $filterOption = $request->query('filter');
            if ($filterOption == 'lunch') {
                // Filter restoran yang punya stok lunch > 0
                $query->whereHas('stocks', function ($q) {
                    $q->where('pickup_time', 'Lunch')->where('stock', '>', 0);
                });
            } elseif ($filterOption == 'dinner') {
                // Filter restoran yang punya stok dinner > 0
                $query->whereHas('stocks', function ($q) {
                    $q->where('pickup_time', 'Dinner')->where('stock', '>', 0);
                });
            }
        }

        // ===========================================
        // LANGKAH 2: TERAPKAN PENGURUTAN (ORDER BY clauses)
        // ===========================================

        if ($request->has('sort')) {
            $sortOption = $request->query('sort');
            switch ($sortOption) {
                case 'best-rating':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        // ===========================================
        // LANGKAH 3: EKSEKUSI QUERY & KIRIM KE VIEW
        // ===========================================

        $eateries = $query->get();

        // Ambil stok lunch & dinner dari tabel restaurant_stocks
        foreach ($eateries as $eatery) {
            $lunchStock = RestaurantStock::where('restaurant_id', $eatery->restaurant_id)
                ->where('pickup_time', 'Lunch')
                ->sum('stock');
            $dinnerStock = RestaurantStock::where('restaurant_id', $eatery->restaurant_id)
                ->where('pickup_time', 'Dinner')
                ->sum('stock');
            $eatery->lunch_stock = $lunchStock;
            $eatery->dinner_stock = $dinnerStock;
        }

        return view('user.eatery', [
            'eateries' => $eateries,
            'selectedSort' => $request->query('sort', 'default'),
            'selectedFilter' => $request->query('filter'),
            'searchQuery' => $request->query('query'),
            'selectedLocation' => $request->query('location')
        ]);
    }

    public function showDetail(Request $request, Restaurant $restaurant)
    {
        $selectedPanel = $request->query('panel', 'what-you-get');
        return view('user.detail', [
            'eatery' => $restaurant,
            'selectedPanel' => $selectedPanel
        ]);
    }
}