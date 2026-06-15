<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminPengaturanController extends Controller
{
    public function index()
    {
        // Mengambil data admin yang sedang login saat ini
        $admin = auth()->user();
        return view('admin.pengaturan.index', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = auth()->user();

        // Validasi inputan
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $admin->id,
            'phone' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ]);

        // Update data dasar
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->alamat = $request->alamat;

        // Jika password baru diisi, maka enkripsi dan update
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('admin.pengaturan.index')
            ->with('success', 'Pengaturan akun dan profil toko berhasil diperbarui.');
    }
}