<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\ProdukGambar;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProdukGambarController extends Controller
{
    // =========================================================================
    // 1. INDEX (Menggunakan parameter $id dari URL /produk/{id}/gambar)
    // =========================================================================
    public function index($id)
    {
        // Mencari produk berdasarkan ID yang ada di URL, sekalian eager load relasinya
        $produk = Produk::with('gambarTambahan')->findOrFail($id);

        return view('admin.produk.gambar', compact('produk'));
    }

    // =========================================================================
    // 2. STORE (Menggunakan parameter $id dari URL untuk mencantolkan gambar baru)
    // =========================================================================
    public function store(Request $request, $id)
    {
        // Validasi input array gambar
        $request->validate([
            'gambar'    => 'required|array|min:1',
            'gambar.*'  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $produk = Produk::findOrFail($id);

        DB::transaction(function () use ($request, $produk) {
            if ($request->hasFile('gambar')) {
                foreach ($request->file('gambar') as $file) {
                    
                    // Laravel otomatis men-generate nama unik di dalam folder 'produk_tambahan'
                    $path = $file->store('produk_tambahan', 'public');

                    ProdukGambar::create([
                        'produk_id' => $produk->id,
                        'gambar'    => $path
                    ]);
                }
            }
        });

        return back()->with('success', 'Gambar galeri berhasil ditambahkan.');
    }

    // =========================================================================
    // 3. DESTROY (Tetap sama, menghapus baris gambar berdasarkan ID gambarnya sendiri)
    // =========================================================================
    public function destroy($id)
    {
        $gambar = ProdukGambar::findOrFail($id);

        // Hapus berkas fisik dari storage disk public
        if ($gambar->gambar && Storage::disk('public')->exists($gambar->gambar)) {
            Storage::disk('public')->delete($gambar->gambar);
        }

        // Hapus record dari database
        $gambar->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}