<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;

class UserKategoriController extends Controller
{
    // ========================================================
    // DISPLAY SEMUA KATEGORI (HALAMAN INDEKS)
    // ========================================================
    public function index()
    {
        // Eager loading relasi 'produk' untuk menghitung jumlah item di halaman utama kategori
        $kategori = Kategori::with('produk')
                            ->where('status', 'aktif')
                            ->latest()
                            ->get();

        return view('users.kategori.index', compact('kategori'));
    }

    // ========================================================
    // DETAIL KATEGORI (MENAMPILKAN DAFTAR PRODUK PER KATEGORI)
    // ========================================================
    public function show($id)
    {
        // PENGAMAN: Mencari SATU data kategori tunggal berdasarkan ID atau Slug.
        // findOrFail menjamin output berbentuk Single Object, bukan Collection instance.
        $kategori = Kategori::where('id', $id)->orWhere('slug', $id)->firstOrFail();

        // Ambil produk yang terikat dengan kategori ini
        // Eager loading 'kategori' & 'varian' agar info stok dan harga termurah aman tanpa lag
        $produk = Produk::with(['kategori', 'varian'])
                    ->where('kategori_id', $kategori->id)
                    ->where('status', 'aktif')
                    ->latest()
                    ->paginate(8);

        return view('users.kategori.show', compact('kategori', 'produk'));
    }
}