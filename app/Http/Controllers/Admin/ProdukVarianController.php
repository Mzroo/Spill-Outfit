<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Ukuran;
use App\Models\Warna;
use App\Models\ProdukVarian;

class ProdukVarianController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        $varian = ProdukVarian::with(['produk', 'ukuran', 'warna'])
            ->latest()
            ->get();

        return view('admin.produk_varian.index', compact('varian'));
    }

    // ================= CREATE =================
    public function create()
    {
        $produk = Produk::all();
        $ukuran = Ukuran::where('status', 'aktif')->get();
        $warna  = Warna::where('status', 'aktif')->get();

        return view('admin.produk_varian.create', compact('produk', 'ukuran', 'warna'));
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'ukuran_id' => 'required|exists:ukuran,id',
            'warna_id'  => 'required|exists:warna,id',
            'stok'      => 'required|integer|min:0',
            'harga'     => 'nullable|integer'
        ]);

        ProdukVarian::create([
            'produk_id' => $request->produk_id,
            'ukuran_id' => $request->ukuran_id,
            'warna_id'  => $request->warna_id,
            'stok'      => $request->stok,
            'harga'     => $request->harga
        ]);

        return redirect()
            ->route('admin.produk-varian.index')
            ->with('success', 'Varian berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $varian = ProdukVarian::findOrFail($id);

        $produk = Produk::all();
        $ukuran = Ukuran::where('status', 'aktif')->get();
        $warna  = Warna::where('status', 'aktif')->get();

        return view('admin.produk_varian.edit', compact('varian', 'produk', 'ukuran', 'warna'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $varian = ProdukVarian::findOrFail($id);

        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'ukuran_id' => 'required|exists:ukuran,id',
            'warna_id'  => 'required|exists:warna,id',
            'stok'      => 'required|integer|min:0',
            'harga'     => 'nullable|integer'
        ]);

        $varian->update([
            'produk_id' => $request->produk_id,
            'ukuran_id' => $request->ukuran_id,
            'warna_id'  => $request->warna_id,
            'stok'      => $request->stok,
            'harga'     => $request->harga
        ]);

        return redirect()
            ->route('admin.produk-varian.index')
            ->with('success', 'Varian berhasil diupdate');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $varian = ProdukVarian::findOrFail($id);
        $varian->delete();

        return redirect()
            ->route('admin.produk-varian.index')
            ->with('success', 'Varian berhasil dihapus');
    }
}