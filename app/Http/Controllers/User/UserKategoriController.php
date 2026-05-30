<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;

class UserKategoriController extends Controller
{
    // =========================
    // SEMUA KATEGORI
    // =========================

    public function index()
    {
        $kategori = Kategori::latest()->get();

        return view('users.kategori.index', compact('kategori'));
    }

    // =========================
    // DETAIL KATEGORI
    // =========================

    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);

        $produk = Produk::with('kategori')
                    ->where('kategori_id', $id)
                    ->where('status', 'public')
                    ->latest()
                    ->paginate(8);

        return view('users.kategori.show', compact(
            'kategori',
            'produk'
        ));
    }
}