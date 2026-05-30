<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Produk;

class UserProdukController extends Controller
{
    // =========================
    // LIST PRODUK
    // =========================
    public function index()
    {
        $produk = Produk::with(['kategori'])
            ->where('status', 'public')
            ->latest()
            ->paginate(8);

        return view('users.produk.index', compact('produk'));
    }

    // =========================
    // DETAIL PRODUK
    // =========================
    public function show($id)
    {
        $produk = Produk::with([
                'kategori',
                'gambarTambahan',
                'varian.warna',
                'varian.ukuran'
            ])
            ->findOrFail($id);

        // REKOMENDASI
        $rekomendasi = Produk::with('kategori')
            ->where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->where('status', 'public')
            ->latest()
            ->take(4)
            ->get();

        return view('users.produk.detail_produk', compact(
            'produk',
            'rekomendasi'
        ));
    }
}