<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $title = 'Profile';
        $subtitle = 'Edit';
        $user = Auth::user();
        return view('admin.profile.edit', compact('user', 'title', 'subtitle'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'profile_picture' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // Maksimal 2MB
        ]);

        // Proses unggah gambar (jika ada)
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pictures'), $filename);

            // Hapus gambar lama jika ada
            if ($user->profile_picture && file_exists(public_path('uploads/profile_pictures/' . $user->profile_picture))) {
                unlink(public_path('uploads/profile_pictures/' . $user->profile_picture));
            }

            // Simpan nama file baru ke validatedData
            $validatedData['profile_picture'] = $filename; // Simpan nama file di array validasi
        } else {
            // Jika tidak ada file baru, gunakan gambar default jika profile_picture kosong
            $validatedData['profile_picture'] = $user->profile_picture ?: 'default.png';
        }

        // Update profil pengguna
        $user->update($validatedData);

        return response()->json([
            'message' => 'Profil berhasil diperbarui.',
        ]);
    }


}
