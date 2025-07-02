<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RestaurantProfileController extends Controller
{
    /**
     * Menampilkan halaman profil restoran.
     */
    public function show() // Akan dipanggil oleh route GET /store/profile
    {
        // Middleware 'auth:resto' akan menangani jika belum login
        $restaurant = Auth::guard('resto')->user(); // Ini objek Restaurant yang login

        if ($restaurant->status_approval === 'pending_details') {
            return redirect()->route('resto.register.details.form')->with('info', 'Please complete your eatery registration to view your profile.');
        }
        if ($restaurant->status_approval !== 'approved') {
             // Jika belum approved (misal pending_review atau rejected)
            return redirect('/store/signin')->with('info', 'Your eatery profile is not active yet. Status: ' . $restaurant->status_approval);
        }
        // View: resources/views/store/show_profile.blade.php (nama view profil Anda)
        return view('store.profilestore', compact('restaurant'));
    }

    /**
     * Menyimpan/Mengupdate detail restoran dari form registerstore.blade.php.
     * Ini adalah method yang tadinya storeEateryDetails di RegisterController.
     */
    public function storeOrUpdateDetails(Request $request)
{
    $restaurant = Auth::guard('resto')->user(); // Objek Restaurant yang login

    if (!$restaurant || $restaurant->status_approval !== 'pending_details') {
        return redirect()->route('resto.profile.show')->with('error', 'Your eatery details can no longer be modified or have already been submitted.');
    }

    // Sesuaikan validasi ini dengan nama input di form Anda dan kebutuhan
    $validator = Validator::make($request->all(), [
        'application_name' => ['required', 'string', 'max:100'],
        'name' => ['required', 'string', 'max:100'], // Pastikan ada input name="restaurant_name"
        'telephone' => ['required', 'string', 'max:20'],
        'location' => ['required', 'string', 'max:255'],      // Dibuat required jika memang wajib
        'operational_hours' => ['required', 'string', 'max:100'],  // Dibuat required
        'food_type' => ['required', 'string', 'max:100'],
        'description' => ['required', 'string'],
        'pricing' => ['required', 'string', 'max:50'], // Ini jadi 'pricing_tier'
        'best_before' => ['nullable', 'string', 'max:255'], // Jika string. Jika DATE, validasi 'date'
        'restaurant_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        'product_sold_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        'bank_account' => ['required', 'string', 'max:50'],
        'account_name' => ['required', 'string', 'max:100'],
        'proof_of_identification_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        'npwp_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        'letter_of_authorization_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        // 'restaurant_contact_email' => ['required', 'string', 'email', 'max:255'], // Jika Anda pakai kolom ini
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $dataToUpdate = [
        'applicant_name' => $request->application_name,
        'name' => $request->name, // Menyimpan nama resmi restoran
        'telephone' => $request->telephone,
        'location' => $request->location, // Pastikan nama input form ini adalah 'restaurant_location'
        'operational_hours' => $request->operational_hours, // Pastikan nama input form ini adalah 'operational_hours'
        'description' => $request->description,
        'food_type' => $request->food_type, // Pastikan nama input form ini adalah 'type_of_food_sold'
        'account_bank' => $request->bank_account,
        'bank_account_name' => $request->account_name,
        'pricing_tier' => $request->pricing,
        'best_before' => $request->best_before,
        // 'restaurant_contact_email' => $request->restaurant_contact_email, // Jika ada
        'status_approval' => 'approved', // AUTO-APPROVE SEMENTARA
    ];

    





    try {
        $restaurant->update($dataToUpdate);
    } catch (\Exception $e) {
        Log::error("Error updating restaurant (ID: {$restaurant->restaurant_id}) details: " . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to submit eatery details. ' . $e->getMessage())->withInput();
    }

    // Tidak perlu update $user->status lagi di sini karena status 'approved' di resto sudah cukup
    // kecuali Anda punya logika status user yang berbeda.
    // Jika User dan Resto adalah entitas login yang sama (Restaurant extends Authenticatable),
    // status_approval di Restaurant sudah cukup.

    return redirect()->route('resto.profile.show')->with('success', 'Your eatery has been registered and approved!');
}
    // Nanti Anda akan buat method edit() dan update() untuk profil yang sudah ada
}