<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\ProdukGambar;

class ProdukGambarController extends Controller
{
    // HALAMAN GAMBAR
    public function index($id)
    {
        $produk = Produk::with('gambarTambahan')->findOrFail($id);

        return view('admin.produk.gambar', compact('produk'));
    }

    // STORE GAMBAR
    public function store(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        if ($request->hasFile('gambar')) {

            foreach ($request->file('gambar') as $file) {

                $namaFile = time() . rand(1,999) . '.' . $file->getClientOriginalExtension();

                $file->storeAs('produk_tambahan', $namaFile, 'public');

                ProdukGambar::create([
                    'produk_id' => $produk->id,
                    'gambar' => 'produk_tambahan/' . $namaFile
                ]);
            }
        }

        return back()->with('success', 'Gambar berhasil ditambahkan');
    }

    // HAPUS
    public function destroy($id)
    {
        $gambar = ProdukGambar::findOrFail($id);

        $gambar->delete();

        return back()->with('success', 'Gambar berhasil dihapus');
    }
}