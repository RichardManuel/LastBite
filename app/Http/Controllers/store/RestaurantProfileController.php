<?php

namespace App\Http\Controllers\store;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RestaurantProfileController extends Controller
{
    /**
     * Show profile page.
     * Logika pengalihan telah dipindahkan ke middleware 'RedirectRestoByStatus'.
     * Controller ini hanya akan berjalan jika status restoran sudah 'accepted'.
     */
    public function show()
    {
        // PENTING: Metode ini hanya akan dipanggil jika middleware 'RedirectRestoByStatus'
        // telah memastikan status restoran adalah 'accepted'.
        $restaurant = Auth::guard('resto')->user();
        return view('store.profilestore', compact('restaurant'));
    }

    /**
     * Store or update detail info.
     */
    public function storeOrUpdateDetails(Request $request)
    {
        $restaurant = Auth::guard('resto')->user();

        Log::info("Restaurant status before submit:", ['status' => $restaurant->status]);

        if (!$restaurant || $restaurant->status !== 'pending_details') {
            return redirect()->route('resto.profile.show')
                ->with('error', 'Your eatery details can no longer be modified.');
        }

        $validator = Validator::make($request->all(), [
            'application_name' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:100'],
            'telephone' => ['required', 'string', 'max:20'],
            'location' => ['required', 'string', 'max:255'],
            'operational_hours' => ['required', 'string', 'max:100'],
            'food_type' => ['required', 'string'],
            'description' => ['required', 'string'],
            'pricing' => ['required', 'string'],
            'best_before' => ['nullable', 'date'],
            'bank_account' => ['required', 'string'],
            'account_name' => ['required', 'string'],
            'restaurant_picture' => ['nullable', 'image', 'max:2048'],
            'product_sold_picture' => ['nullable', 'image', 'max:2048'], // <<-- Tambah validasi ini
            'proof_of_identification_picture' => ['nullable', 'image', 'max:2048'],
            'npwp_picture' => ['nullable', 'image', 'max:2048'],
            'letter_of_authorization_picture' => ['nullable', 'image', 'max:2048'],
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
            'status' => 'pending_approval',
            
        ];

        if ($request->best_before) {
            $dataToUpdate['best_before'] = \Carbon\Carbon::parse($request->best_before)->format('Y-m-d');
        }

        // Gambar restoran
        if ($request->hasFile('restaurant_picture')) {
            $dataToUpdate['restaurant_picture_path'] = $request->file('restaurant_picture')->store('restaurant_pictures', 'public');
        }

        // Gambar produk yang dijual
        if ($request->hasFile('product_sold_picture')) {
            $dataToUpdate['product_sold_picture_path'] = $request->file('product_sold_picture')->store('resto_documents', 'public');
        }

        // Dokumen identitas
        if ($request->hasFile('proof_of_identification_picture')) {
            $dataToUpdate['id_proof_document_path'] = $request->file('proof_of_identification_picture')->store('resto_documents', 'public');
        }

        // NPWP
        if ($request->hasFile('npwp_picture')) {
            $dataToUpdate['npwp_document_path'] = $request->file('npwp_picture')->store('resto_documents', 'public');
        }

        // Surat kuasa
        if ($request->hasFile('letter_of_authorization_picture')) {
            $dataToUpdate['authorization_document_path'] = $request->file('letter_of_authorization_picture')->store('resto_documents', 'public');
        }

        try {
            $restaurant->update($dataToUpdate);
            Log::info("Restaurant status after submit:", ['status' => $restaurant->fresh()->status]);
        } catch (\Exception $e) {
            Log::error("Error updating restaurant: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to submit details.');
        }

        return redirect()->route('resto.profile.show')
            ->with('success', 'Your details have been submitted and are pending approval.');
    }


    /**
     * Edit profile (when accepted).
     */
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
            'best_before' => 'nullable|date',
            'account_bank' => 'nullable|string',
            'bank_account_name' => 'nullable|string',
            'restaurant_picture' => 'nullable|image|max:2048',
        ]);

        if ($request->best_before) {
            $validated['best_before'] = \Carbon\Carbon::parse($request->best_before)->format('Y-m-d');
        }

        if ($request->hasFile('restaurant_picture')) {
            $validated['restaurant_picture_path'] = $request->file('restaurant_picture')->store('restaurant_pictures', 'public');
        }

        $restaurant->fill($validated);
        $restaurant->save();

        return redirect()->route('resto.profile.show')->with('success', 'Profile updated.');
    }
}
