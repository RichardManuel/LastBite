<?php

namespace App\Http\Controllers; // 

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

// Ubah nama class agar sesuai dengan nama file
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
            // Ubah kata kunci pencarian menjadi huruf kecil
            $searchQuery = strtolower($request->query('query'));
            
            $query->where(function ($q) use ($searchQuery) {
                // Bandingkan dengan kolom 'name' yang juga sudah diubah menjadi huruf kecil
                $q->where(DB::raw('LOWER(name)'), 'LIKE', "%{$searchQuery}%")
                // Bandingkan dengan kolom 'food_type' yang juga sudah diubah menjadi huruf kecil
                ->orWhere(DB::raw('LOWER(food_type)'), 'LIKE', "%{$searchQuery}%");
            });
        }

        // search lokasi ini bro
        if ($request->filled('location')) {
            $locationQuery = strtolower($request->query('location'));
            
            // Cari restoran di mana kolom 'location' mengandung nama kota yang dipilih
            // Kita gunakan LOWER() untuk pencarian case-insensitive
            $query->where(DB::raw('LOWER(location)'), 'LIKE', "%{$locationQuery}%");
        }

        // --- LOGIKA FILTER (LUNCH/DINNER) ---
        if ($request->has('filter')) {
            $filterOption = $request->query('filter');
            if ($filterOption == 'lunch') {
                $query->where('lunch_stock', '>', 0);
            } elseif ($filterOption == 'dinner') {
                $query->where('dinner_stock', '>', 0);
            }
        }

        // ===========================================
        // LANGKAH 2: TERAPKAN PENGURUTAN (ORDER BY clauses)
        // ===========================================

        // --- LOGIKA SORT ---
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
            // Urutan default jika tidak ada parameter sort
            $query->latest();
        }

        // ===========================================
        // LANGKAH 3: EKSEKUSI QUERY & KIRIM KE VIEW
        // ===========================================

        $eateries = $query->get();
        
        // dd($query->toSql(), $query->getBindings());

        return view('eatery', [
            'eateries' => $eateries,
            'selectedSort' => $request->query('sort', 'default'),
            'selectedFilter' => $request->query('filter'),
            'searchQuery' => $request->query('query'),
            'selectedLocation' => $request->query('location')
        ]);
    }

    public function showDetail(Request $request, Restaurant $restaurant)
    {
        // KEAJAIBAN LARAVEL (Route Model Binding):
        // 1. Laravel melihat ada parameter {restaurant} di route.
        // 2. Laravel melihat ada variabel $restaurant di method ini.
        // 3. Laravel melihat tipenya adalah model 'Restaurant'.
        // 4. Secara otomatis, Laravel akan menjalankan query: 
        //    `Restaurant::findOrFail($nilai_dari_url);`
        // Jadi, kita tidak perlu menulis kode pencarian manual!

        $selectedPanel = $request->query('panel', 'what-you-get');

        // Kirim data restoran yang sudah ditemukan ke view 'detail.blade.php'
        // Kita kirim dengan nama variabel 'eatery' agar bisa diakses di view
        return view('detail', [
        'eatery' => $restaurant,
        'selectedPanel' => $selectedPanel
    ]);
    }

    

}