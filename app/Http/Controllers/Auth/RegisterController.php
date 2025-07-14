<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Restaurant; // Model untuk tabel restaurants (yang authenticatable)
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
// use App\Models\User; // Tidak kita gunakan lagi di sini untuk signup resto

class RegisterController extends Controller
{
    /**
     * Menampilkan form signup awal untuk Resto.
     */
    public function showRegistrationForm() // Akan dipanggil oleh route GET /store/signup
    {
        return view('store.signup'); // View: resources/views/store/signup.blade.php
    }

    /**
     * Memproses signup awal untuk Resto.
     * Membuat akun di tabel 'restaurants' dan login menggunakan guard 'resto'.
     */
    public function processRestoSignup(Request $request)
    {
        //  dd('PROCESS_RESTO_SIGNUP #1: Request Data', $request->all());

        $validator = Validator::make($request->all(), [
            // 'owner_name' => ['required', 'string', 'max:100'], // Jika ada input owner_name
            'email' => ['required', 'string', 'email', 'max:255', 'unique:restaurants,email'], // Validasi ke kolom 'email' di tabel 'restaurants'
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['accepted'],
        ]);

        if ($validator->fails()) {
            // dd('PROCESS_RESTO_SIGNUP #2: Validasi GAGAL', $validator->errors()->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // dd('PROCESS_RESTO_SIGNUP #3: Validasi BERHASIL');

        $emailParts = explode('@', $request->email);
        // Jika Anda punya kolom 'owner_name' di tabel restaurants dan ingin mengisinya dari awal:
        $defaultOwnerName = $request->input('owner_name', $emailParts[0]); // Ambil dari input atau default

        $restaurantData = [
            // 'owner_name' => $defaultOwnerName,    // Jika ada kolom owner_name
            'email' => $request->email,           // Mengisi kolom 'email' (ini harus nama kolom email login Anda di DB)
            'password' => $request->password,        // Model Restaurant akan hash ini
            'status_approval' => 'pending_details',
            'name' => $defaultOwnerName . "'s Eatery (Pending Details)", // Nama restoran sementara
            'location' => 'Pending Location',
            'operational_hours' => 'Pending Hours',
            'food_type' => 'Pending Type',
            'applicant_name' => $defaultOwnerName, // Bisa diisi dengan nama default juga
            'telephone' => '00000',
        ];

        $createdRestaurant = null;
        try {
            // Simpan ke variabel sementara dulu, karena create() mungkin tidak langsung return ID untuk PK string kustom
            $createdRestaurantInstance = Restaurant::create($restaurantData);

            if (!$createdRestaurantInstance) { // Jika create gagal mengembalikan instance model
                Log::error("Restaurant::create() returned null. Data: " . json_encode($restaurantData));
                return redirect()->back()->with('error', 'Failed to initiate restaurant account creation.')->withInput();
            }

            // PENTING: Ambil ulang record dari database menggunakan email (yang unik)
            // untuk memastikan kita mendapatkan restaurant_id yang di-generate oleh PostgreSQL.
            $restaurant = Restaurant::where('email', $createdRestaurantInstance->email)->first();

        } catch (\Exception $e) {
            Log::error("Error creating restaurant account: " . $e->getMessage() . " Data: " . json_encode($restaurantData));
            dd('PROCESS_RESTO_SIGNUP #4: GAGAL saat Restaurant::create() atau pengambilan ulang', $e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('error', 'Failed to create restaurant account. ' . $e->getMessage())->withInput();
        }

        // dd('PROCESS_RESTO_SIGNUP #5: Setelah Restaurant::create() DAN PENGAMBILAN ULANG', $restaurant);

        if (!$restaurant || !$restaurant->restaurant_id) { // Cek primary key SETELAH DIAMBIL ULANG
            Log::error("Restaurant object null or restaurant_id missing AFTER REFRESH/FIND. Data: " . json_encode($restaurantData) . " Found Restaurant: " . json_encode($restaurant));
            return redirect()->back()->with('error', 'Failed to process restaurant account (ID not retrieved). Please try again.')->withInput();
        }

        // dd('PROCESS_RESTO_SIGNUP #6: Restaurant BERHASIL diproses dan restaurant_id ADA:', $restaurant);

        Auth::guard('resto')->login($restaurant);

        // dd('PROCESS_RESTO_SIGNUP #7: Resto LOGIN, akan redirect ke resto.register.details.form', Auth::guard('resto')->user());

        return redirect()->route('resto.register.details.form')
                        ->with('success', 'Restaurant account created! Please complete your registration details.');
    }

// Method showEateryDetailsForm tetap sama, menampilkan form registerstore
// dan mengirimkan objek $restaurant yang sedang login (yang statusnya pending_details)
    public function showEateryDetailsForm()
    {
        $restaurant = Auth::guard('resto')->user(); // Mendapatkan instance Restaurant yang login

        if (!$restaurant || $restaurant->status_approval !== 'pending_details') {
            if ($restaurant) { // Jika ada record restoran tapi statusnya bukan pending_details
                // Cek apakah sudah diapprove, jika ya arahkan ke profil
                if ($restaurant->status_approval === 'approved') {
                    return redirect()->route('resto.profile.show')->with('info', 'Your eatery profile is already active.');
                }
                // Jika status lain (misal pending_review, rejected)
                return redirect()->route('resto.login.form')->with('info', 'Your eatery details are in status: ' . $restaurant->status_approval);
            }
            // Jika tidak ada $restaurant (seharusnya tidak terjadi jika sudah login dengan guard resto)
            return redirect()->route('resto.login.form')->with('error', 'Please login to complete your eatery details.');
        }
        return view('store.registerstore', compact('restaurant')); // View: resources/views/store/registerstore.blade.php
    }
}
