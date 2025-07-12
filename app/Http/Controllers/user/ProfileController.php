<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user(); // Get currently logged-in user
        return view('user.userprofile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user(); // same user
        return view('user.editprofile', compact('user'));
    }

    // Handle profile update
    public function update(Request $request)
    {
        $user = Auth::user();
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'city' => 'nullable|string|max:100',
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string|max:255',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg|max:8192',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->city = $request->city;
        $user->phone = $request->phone;
        $user->notes = $request->notes;

        // Handle image only if uploaded

        // Handle image only if uploaded
        if ($request->hasFile('img_path')) {
            // Hapus file lama jika ada
            if ($user->img_path && Storage::disk('public')->exists('uploads/' . $user->img_path)) {
                Storage::disk('public')->delete('uploads/' . $user->img_path);
            }

            // Simpan file baru
            $filename = time() . '.' . $request->img_path->getClientOriginalExtension();
            $path = $request->file('img_path')->storeAs('uploads', $filename, 'public');

            $user->img_path = $filename;
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
