<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // =========================
    // INDEX
    // =========================
    public function index()
    {
        $produk = Produk::with(['kategori', 'brand'])->latest()->get();

        return view('admin.produk.index', compact('produk'));
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        $kategori = Kategori::all();
        $brand = Brand::all();

        return view('admin.produk.create', compact('kategori', 'brand'));
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:produk,kode',
            'nama' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'brand_id' => 'nullable|exists:brand,id',
            'harga' => 'required|numeric',
            'status' => 'required|in:public,block',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'brand_id' => $request->brand_id,
            'harga' => $request->harga,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        $brand = Brand::all();

        return view('admin.produk.edit', compact('produk', 'kategori', 'brand'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:produk,kode,' . $id,
            'nama' => 'required',
            'kategori_id' => 'required|exists:kategori,id',
            'brand_id' => 'nullable|exists:brand,id',
            'harga' => 'required|numeric',
            'status' => 'required|in:public,block',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $gambar = $produk->gambar;

        if ($request->hasFile('gambar')) {

            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $gambar = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kategori_id' => $request->kategori_id,
            'brand_id' => $request->brand_id,
            'harga' => $request->harga,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil diupdate');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}