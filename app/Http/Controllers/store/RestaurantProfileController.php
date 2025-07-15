<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\RestaurantApplication;

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
            'name' => ['required', 'string', 'max:100'],
            'telephone' => ['required', 'string', 'max:20'],
            'location' => ['required', 'string', 'max:255'],
            'operational_hours' => ['required', 'string', 'max:100'],
            'food_type' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'pricing' => ['required', 'string', 'max:50'],
            'best_before' => ['nullable', 'string', 'max:255'],
            'restaurant_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'product_sold_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'bank_account' => ['required', 'string', 'max:50'],
            'account_name' => ['required', 'string', 'max:100'],
            'proof_of_identification_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'npwp_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'letter_of_authorization_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dataToUpdate = [
            'applicant_name' => $request->application_name,
            'name' => $request->name,
            'telephone' => $request->telephone,
            'location' => $request->location,
            'operational_hours' => $request->operational_hours,
            'description' => $request->description,
            'food_type' => $request->food_type,
            'account_bank' => $request->bank_account,
            'bank_account_name' => $request->account_name,
            'pricing_tier' => $request->pricing,
            'best_before' => $request->best_before,
            'status_approval' => 'pending_review
            ', // AUTO-APPROVE SEMENTARA
        ];


        // Cek dan simpan file gambar jika diupload
        if ($request->hasFile('restaurant_picture')) {
            $restaurantPicturePath = $request->file('restaurant_picture')->store('restaurant_pictures', 'public');
            $dataToUpdate['restaurant_picture_path'] = $restaurantPicturePath;
        }

        if ($request->hasFile('product_sold_picture')) {
            $productPicturePath = $request->file('product_sold_picture')->store('product_pictures', 'public');
            $dataToUpdate['product_sold_picture_path'] = $productPicturePath;
        }

        if ($request->hasFile('proof_of_identification_picture')) {
            $proofPath = $request->file('proof_of_identification_picture')->store('identifications', 'public');
            $dataToUpdate['id_proof_document_path'] = $proofPath;
        }

        if ($request->hasFile('npwp_picture')) {
            $npwpPath = $request->file('npwp_picture')->store('npwp', 'public');
            $dataToUpdate['npwp_document_path'] = $npwpPath;
        }

        if ($request->hasFile('letter_of_authorization_picture')) {
            $loaPath = $request->file('letter_of_authorization_picture')->store('authorization_letters', 'public');
            $dataToUpdate['authorization_document_path'] = $loaPath;
        }





        try {
            $restaurant->update($dataToUpdate);
            $restaurant->refresh();

            RestaurantApplication::create([
                'restaurant_name' => $restaurant->name,
                'restaurant_location' => $restaurant->location,
                'operational_hours' => $restaurant->operational_hours,
                'description' => $restaurant->description,
                'food_type' => $restaurant->food_type,
                'restaurant_email' => $restaurant->email,
                'password_hash' => $restaurant->getOriginal('password'),
                'applicant_name' => $restaurant->applicant_name,
                'applicant_phone' => $restaurant->telephone,
                'pricing_tier' => $restaurant->pricing_tier,
                'account_bank' => $restaurant->account_bank,
                'bank_account_name' => $restaurant->bank_account_name,
                'name_accountable' => $restaurant->name_accountable ?? $restaurant->bank_account_name,
                'npwp_document_path' => $restaurant->npwp_document_path,
                'authorization_document_path' => $restaurant->authorization_document_path,
                'id_proof_document_path' => $restaurant->id_proof_document_path,
                'restaurant_photos' => json_encode([$restaurant->restaurant_picture_path]),
                'product_photos' => json_encode([$restaurant->product_sold_picture_path]),
                'best_before' => $restaurant->best_before,
                'notes' => 'Auto-generated from restaurant registration.',
            ]);
        } catch (\Exception $e) {
            Log::error("Error updating restaurant (ID: {$restaurant->restaurant_id}) details: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to submit eatery details. ' . $e->getMessage())->withInput();
        }


        return redirect()->route('resto.profile.show')->with('success', 'Your eatery has been registered and approved!');
    }

    // Nanti Anda akan buat method edit() dan update() untuk profil yang sudah ada
    public function edit()
    {
        $restaurant = Auth::guard('resto')->user();
        return view('store.editprofile', compact('restaurant'));
    }

    public function update(Request $request)
    {
        $restaurant = Auth::guard('resto')->user();


        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'email' => 'required|email',
            'telephone' => 'nullable|string|max:20',
            'operational_hours' => 'nullable|string',
            'applicant_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'food_type' => 'nullable|string',
            'pricing_tier' => 'nullable|string',
            'best_before' => 'nullable|string',
            'account_bank' => 'nullable|string',
            'bank_account_name' => 'nullable|string',
            'restaurant_picture' => 'nullable|image|max:2048',
        ]);

        // Simpan file gambar jika ada
        if ($request->hasFile('restaurant_picture')) {
            $path = $request->file('restaurant_picture')->store('restaurant_pictures', 'public');
            $restaurant->restaurant_picture_path = $path;
        }

        // Isi satu per satu supaya kamu bisa debug jika ada masalah
        $restaurant->name = $validated['name'];
        $restaurant->location = $validated['location'] ?? null;
        $restaurant->email = $validated['email'];
        $restaurant->telephone = $validated['telephone'] ?? null;
        $restaurant->operational_hours = $validated['operational_hours'] ?? null;
        $restaurant->applicant_name = $validated['applicant_name'];
        $restaurant->description = $validated['description'] ?? null;
        $restaurant->food_type = $validated['food_type'] ?? null;
        $restaurant->pricing_tier = $validated['pricing_tier'] ?? null;
        $restaurant->best_before = $validated['best_before'] ?? null;
        $restaurant->account_bank = $validated['account_bank'] ?? null;
        $restaurant->bank_account_name = $validated['bank_account_name'] ?? null;

        $restaurant->save(); // Save update
        return redirect()->route('resto.profile.show')->with('success', 'Profile updated.');
    }
}
