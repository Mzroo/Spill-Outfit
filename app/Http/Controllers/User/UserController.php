<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CommunityPost;
use App\Models\Produk; 
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (DASHBOARD USER)
    |--------------------------------------------------------------------------
    | Menampilkan halaman depan dashboard user beserta data kategori,
    | produk trending, produk rekomendasi, dan data postingan komunitas.
    |
    */
    public function index()
    {
        // 1. Ambil semua data kategori untuk section "Explore Style"
        $kategori = Kategori::all();

        // 2. Ambil 4 data produk teranyar dengan status 'public' untuk dipasang di section "Trending"
        $produk_trending = Produk::with(['kategori'])
                            ->where('status', 'public')
                            ->latest()
                            ->take(4) // Sesuai dengan pembagian grid desktop 4 kolom
                            ->get();

        // =========================================================================
        // TAMBAHAN BARU: Query Data untuk Section "Rekomendasi Outfit"
        // =========================================================================
        // Menggunakan inRandomOrder() agar item berbeda dengan isi yang ada di Trending
        $produk_rekomendasi = Produk::with(['kategori', 'varian'])
                                ->where('status', 'public')
                                ->inRandomOrder() 
                                ->take(4) // Mengambil 4 item untuk susunan grid catalog
                                ->get();

        // 3. Ambil 3 data postingan terbaru dari komunitas forum
        $posts = CommunityPost::with(['user'])
                    ->where('status', 'published')
                    ->latest()
                    ->take(3)
                    ->get();

        // 4. Lempar semua data ke halaman dashboard utama user (Compact produk_rekomendasi disertakan)
        return view('users.dashboard', compact('kategori', 'produk_trending', 'posts', 'produk_rekomendasi'));
    }

    /*
    |--------------------------------------------------------------------------
    | ABOUT
    |--------------------------------------------------------------------------
    */
    public function about()
    {
        return view('users.about.index');
    }

    /*
    |--------------------------------------------------------------------------
    | SETTINGS (HALAMAN EDIT PROFILE)
    |--------------------------------------------------------------------------
    */
    public function settings()
    {
        return view('users.settings.index');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE SETTINGS (PROSES SIMPAN DATA PROFIL & ALAMAT)
    |--------------------------------------------------------------------------
    */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'nullable|string|max:20',
            'provinsi' => 'nullable|string|max:100',
            'kota'     => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'alamat'   => 'nullable|string',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        $user = auth()->user();
        $avatar = $user->avatar;

        if ($request->hasFile('foto')) {
            if ($user->avatar && !str_starts_with($user->avatar, 'http')) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatar = $request->file('foto')->store('profile', 'public');
        }

        $user->update([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'provinsi' => $request->provinsi,
            'kota'     => $request->kota,
            'kode_pos' => $request->kode_pos,
            'alamat'   => $request->alamat,
            'avatar'   => $avatar,
        ]);

        return back()->with('success', 'Profile berhasil diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH PRODUK
    |--------------------------------------------------------------------------
    */
    public function search(Request $request)
    {
        $keyword = trim($request->input('search'));
        
        if (empty($keyword)) {
            return redirect()->route('user.produk.index');
        }

        $produk = Produk::with(['kategori', 'varian'])
                    ->where('status', 'public') 
                    ->where(function($q) use ($keyword) {
                        $q->where(DB::raw('LOWER(nama)'), 'LIKE', '%' . strtolower($keyword) . '%')
                          ->orWhere(DB::raw('LOWER(deskripsi)'), 'LIKE', '%' . strtolower($keyword) . '%');
                    })
                    ->latest()
                    ->paginate(12);

        return view('users.partials.search-results', compact('produk', 'keyword'));
    }
}