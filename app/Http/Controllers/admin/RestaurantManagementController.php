<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantManagementController extends Controller
{
    /**
     * Menampilkan HALAMAN daftar aplikasi.
     * Dipanggil oleh rute /admin/applications
     */
    public function showPage()
    {
        // Cukup tampilkan view-nya
        $restaurants = Restaurant::with('application')->latest()->get();
        // dd($applications);
        return view('resto-management',['restaurants' => $restaurants]);
    }

    /**
     * Mengambil DATA aplikasi yang 'pending' untuk JavaScript.
     * Dipanggil oleh rute /admin/api/applications
     * Konvensi Laravel menggunakan 'index' untuk menampilkan daftar resource.
     */
    // public function index()
    // {
    //     // Menggunakan nama kolom 'status' yang benar sesuai database Anda
    //     $applications = RestaurantApplication::where('status', 'pending')->latest()->get();

    //     // Mengembalikan data sebagai JSON
    //     return response()->json($applications);
    // }

    // Nanti Anda bisa menambahkan fungsi accept/decline di sini

    public function destroy(Restaurant $restaurant)
    {
        // Pastikan restoran ini punya aplikasi terkait
        if (!$restaurant->application) {
            return response()->json(['message' => 'Cannot suspend: Original application data not found.'], 404);
        }

        try {
            // Gunakan transaksi untuk memastikan kedua aksi berhasil atau tidak sama sekali
            DB::transaction(function () use ($restaurant) {
                // Langkah 1: Ubah status di tabel aplikasi menjadi 'suspended'
                $restaurant->application()->update(['status' => 'suspended']);

                // Langkah 2: Hapus entri restoran dari tabel 'restaurants'
                $restaurant->delete();
            });

            return response()->json(['message' => 'Restaurant has been suspended successfully.']);

        } catch (\Exception $e) {
            // Log::error('Suspend failed: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to suspend the restaurant. An error occurred.'], 500);
        }
    }
}
