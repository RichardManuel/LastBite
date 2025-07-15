<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantApplication;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class RestaurantApplicationController extends Controller
{
    /**
     * Menampilkan HALAMAN daftar aplikasi.
     * Dipanggil oleh rute /admin/applications
     */
    public function showPage()
    {
        // Cukup tampilkan view-nya
        $applications = RestaurantApplication::where('status', 'pending')->latest()->get();
        // dd($applications);
        return view('resto-application',['applications' => $applications]); 
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

    public function accept(RestaurantApplication $application)
    {
        // 1. Pastikan aplikasi ini belum diproses sebelumnya
        if ($application->status !== 'pending') {
            return response()->json(['message' => 'This application has already been processed.'], 409); // 409 Conflict
        }

        try {
            // 2. Gunakan Transaksi Database untuk memastikan integritas data
            // Jika ada yang gagal di dalam blok ini, semua perubahan akan dibatalkan.
            DB::transaction(function () use ($application) {
                // Langkah A: Update status aplikasi menjadi 'accepted'
                $application->update(['status' => 'accepted']);

                // Langkah B: Buat entri baru di tabel 'restaurants'
                Restaurant::create([
                    'restaurant_application_id' => $application->id,
                    'name'                      => $application->restaurant_name, // 'name' di restaurants diambil dari 'restaurant_name' di applications
                    'location'                  => $application->location,
                    'rating'                    => 0, // Nilai default saat restoran baru dibuat
                    'reviews_count'             => 0, // Nilai default
                    'operational_time'          => $application->operational_time,
                    'description'               => $application->description,
                    'food_type'                 => $application->food_type,
                    'applicant_name'            => $application->applicant_name,
                    'email'                     => $application->email,
                    'telephone'                 => $application->telephone,
                    'bank_account'              => $application->bank_account,
                    'account_name'              => $application->account_name,
                    'pricing'                   => $application->pricing,
                    'best_before'               => $application->best_before,
                    'picture_of_restaurant'     => $application->picture_of_restaurant,
                    'picture_of_products'       => $application->picture_of_products,
                    'lunch_stock'               => 0,
                    'dinner_stock'              => 0,
                    // Salin data lain jika diperlukan
                ]);
            });

            // 3. Jika transaksi berhasil, kirim respons sukses
            return response()->json(['message' => 'Application accepted and restaurant created successfully!']);

        } catch (\Exception $e) {
            // 4. Jika terjadi error, kirim respons gagal
            // Anda bisa mencatat error ini untuk debugging
            // Log::error($e->getMessage());
            return response()->json(['message' => 'An error occurred. Could not process the application.'], 500);
        }
    }

    public function decline(RestaurantApplication $application)
    {
        // 1. Pastikan aplikasi ini masih dalam status 'pending'
        if ($application->status !== 'pending') {
            return response()->json(['message' => 'This application has already been processed.'], 409); // 409 Conflict
        }

        try {
            // 2. Hapus record aplikasi dari database secara permanen
            $application->update(['status' => 'declined']);
            
            // Tidak perlu transaksi database karena hanya ada satu aksi.
            // Jika Anda ingin mengubah statusnya menjadi 'declined' SEBELUM menghapus (misalnya untuk trigger event),
            // Anda bisa melakukannya, tapi itu tidak perlu jika tujuannya hanya menghapus.

            // 3. Kirim respons sukses
            return response()->json(['message' => 'Application declined and removed successfully.']);

        } catch (\Exception $e) {
            // 4. Tangani jika ada error yang tidak terduga saat proses penghapusan
            // Log::error('Failed to decline application: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred. Could not process the application.'], 500);
        }
    }
}