<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CommunityPost;
use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        // 2. Ambil 3 postingan terbaru untuk dipajang di halaman depan
        $posts = CommunityPost::with(['user.profile'])
                    ->where('status', 'published')
                    ->latest()
                    ->take(3) // Batasi hanya 3 data agar pas dengan grid col-lg-4
                    ->get();

        // 3. Kirim variabel $posts ke file blade utama Anda
        return view('users.dashboard', compact('posts'));
    }

    public function about()
    {
        return view('users.about.index');
    }

    public function settings()
    {
        return view('users.settings.index');
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'no_hp'         => 'nullable|string|max:20',
            'provinsi'      => 'nullable|string|max:100',
            'kota'          => 'nullable|string|max:100',
            'kode_pos'      => 'nullable|string|max:10',
            'alamat'        => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();

        // ambil profile user
        $profile = $user->profile;

        // kalau profile belum ada
        if (!$profile) {

            $profile = Profile::create([
                'user_id' => $user->id,
            ]);
        }

        // default foto lama
        $foto = $profile->foto;

        // upload foto baru
        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($profile->foto) {

                Storage::disk('public')
                    ->delete($profile->foto);
            }

            // simpan foto baru
            $foto = $request
                ->file('foto')
                ->store('profile', 'public');
        }

        // update data profile
        $profile->update([
            'nama_penerima' => $request->nama_penerima,
            'no_hp'         => $request->no_hp,
            'provinsi'      => $request->provinsi,
            'kota'          => $request->kota,
            'kode_pos'      => $request->kode_pos,
            'alamat'        => $request->alamat,
            'foto'          => $foto,
        ]);

        return back()->with(
            'success',
            'Profile berhasil diperbarui'
        );
    }
}