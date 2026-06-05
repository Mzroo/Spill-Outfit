<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Ukuran;
use App\Models\Warna;
use App\Models\ProdukVarian;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProdukVarianController extends Controller
{
    // =========================================================================
    // 1. INDEX (Mengirim data Varian, Ukuran, dan Warna sekaligus untuk Modal)
    // =========================================================================
    public function index(Request $request)
    {
        $produkId = $request->query('produk_id');
        
        if (!$produkId) {
            return redirect()->route('admin.produk.index')->with('error', 'Silakan pilih produk terlebih dahulu.');
        }

        $produk = Produk::findOrFail($produkId);

        // Ambil varian khusus produk ini beserta relasinya
        $varian = ProdukVarian::with(['ukuran', 'warna'])
            ->where('produk_id', $produkId)
            ->latest()
            ->get();

        // Ambil opsi master ukuran & warna aktif untuk disuntikkan ke dalam dropdown Modal
        $ukuran = Ukuran::where('status', 'aktif')->get();
        $warna  = Warna::where('status', 'aktif')->get();

        return view('admin.produk_varian.index', compact('varian', 'produk', 'ukuran', 'warna'));
    }

    // =========================================================================
    // 2. STORE (Simpan Varian Baru via Modal)
    // =========================================================================
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'ukuran_id' => [
                'required',
                'exists:ukuran,id',
                Rule::unique('produk_varian')->where(function ($query) use ($request) {
                    return $query->where('produk_id', $request->produk_id)
                                 ->where('warna_id', $request->warna_id);
                })
            ],
            'warna_id'  => 'required|exists:warna,id',
            'stok'      => 'required|integer|min:0',
            'harga'     => 'nullable|integer|min:0'
        ], [
            'ukuran_id.unique' => 'Kombinasi warna dan ukuran untuk produk ini sudah terdaftar.'
        ]);

        DB::transaction(function () use ($request) {
            ProdukVarian::create([
                'produk_id' => $request->produk_id,
                'ukuran_id' => $request->ukuran_id,
                'warna_id'  => $request->warna_id,
                'stok'      => $request->stok,
                'harga'     => $request->harga ?: null
            ]);
        });

        return back()->with('success', 'Kombinasi varian baru berhasil ditambahkan.');
    }

    // =========================================================================
    // 3. UPDATE (Perbarui Varian via Modal)
    // =========================================================================
    public function update(Request $request, $id)
    {
        $varian = ProdukVarian::findOrFail($id);

        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'ukuran_id' => [
                'required',
                'exists:ukuran,id',
                Rule::unique('produk_varian')->where(function ($query) use ($request, $id) {
                    return $query->where('produk_id', $request->produk_id)
                                 ->where('warna_id', $request->warna_id);
                })->ignore($id)
            ],
            'warna_id'  => 'required|exists:warna,id',
            'stok'      => 'required|integer|min:0',
            'harga'     => 'nullable|integer|min:0'
        ], [
            'ukuran_id.unique' => 'Kombinasi warna dan ukuran ini sudah digunakan oleh varian lain produk ini.'
        ]);

        DB::transaction(function () use ($request, $varian) {
            $varian->update([
                'produk_id' => $request->produk_id,
                'ukuran_id' => $request->ukuran_id,
                'warna_id'  => $request->warna_id,
                'stok'      => $request->stok,
                'harga'     => $request->harga ?: null
            ]);
        });

        return back()->with('success', 'Data varian berhasil diperbarui.');
    }

    // =========================================================================
    // 4. DESTROY
    // =========================================================================
    public function destroy($id)
    {
        $varian = ProdukVarian::findOrFail($id);
        $varian->delete();

        return back()->with('success', 'Varian berhasil dihapus.');
    }
}