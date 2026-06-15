<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CommunityPost;
use App\Models\Produk;   
use App\Models\Kategori; 
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (HALAMAN UTAMA GUEST)
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        // 1. Ambil semua data kategori untuk section "Explore Style" & Tombol Filter
        $kategori = Kategori::where('status', 'aktif')->get();

        // 2. Ambil 8 data produk teranyar untuk section "Trending"
        // Diubah menjadi take(8) agar variasi filter kategori lebih berasa dan pas 2 baris grid (4x2)
        $produk_trending = Produk::with(['kategori'])
                            ->where('status', 'public')
                            ->latest()
                            ->take(8) // <-- OPTIMASI DI SINI
                            ->get();

        // 3. Ambil 4 data produk acak untuk section "Rekomendasi Outfit"
        $produk_rekomendasi = Produk::with(['kategori', 'varian'])
                                ->where('status', 'public')
                                ->inRandomOrder() 
                                ->take(4)
                                ->get();

        // 4. Kirim ketiga data di atas ke view 'guest.index'
        return view('guest.index', compact('kategori', 'produk_trending', 'produk_rekomendasi'));
    }

    /*
    |--------------------------------------------------------------------------
    | ABOUT
    |--------------------------------------------------------------------------
    */
    public function about()
    {
        return view('guest.about');
    }

    /*
    |--------------------------------------------------------------------------
    | PRODUK KATALOG (PERBAIKAN: SEKARANG 100% DINAMIS & SUPORT FILTER)
    |--------------------------------------------------------------------------
    */
    public function produk(Request $request)
    {
        // 1. Ambil semua kategori aktif untuk tombol filter
        $kategori = Kategori::where('status', 'aktif')->get();

        // 2. Tangkap parameter filter dan search dari URL
        $kategoriId = $request->query('kategori');
        $search = $request->query('search'); 

        // 3. Siapkan query dasar produk public
        $query = Produk::with(['kategori', 'varian'])->where('status', 'public');

        // Saring berdasarkan Kategori jika ada
        if ($kategoriId) {
            $query->where('kategori_id', $kategoriId);
        }

        // Saring berdasarkan Kata Kunci Search jika ada (Mencari di nama atau deskripsi produk)
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                ->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        }

        // 4. Ambil data dengan pagination asli bawaan Laravel beserta query string-nya
        $produk = $query->latest()->paginate(12)->withQueryString();

        return view('guest.produk.index', compact('produk', 'kategori'));
    }

    /*
    |--------------------------------------------------------------------------
    | COMMUNITY (PREVIEW GUEST)
    |--------------------------------------------------------------------------
    */
    public function community()
    {
        // Ambil 6 postingan terbaru untuk preview guest beserta relasi user dan profilnya
        $posts = CommunityPost::with(['user.profile'])
                    ->latest()
                    ->take(6)
                    ->get();

        // Kirim data $posts ke view guest.community
        return view('guest.community', compact('posts'));
    }
}