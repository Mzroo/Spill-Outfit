<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    // ================= INDEX =================

    public function index()
    {
        $kategori = Kategori::latest()->get();

        return view(
            'admin.kategori.index',
            compact('kategori')
        );
    }

    // ================= CREATE =================

    public function create()
    {
        return view('admin.kategori.create');
    }

    // ================= STORE =================

    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $gambar = null;

        // Upload gambar
        if ($request->hasFile('gambar')) {

            $gambar = $request
                ->file('gambar')
                ->store('kategori', 'public');
        }

        Kategori::create([
            'nama'   => $request->nama,
            'slug'   => Str::slug($request->nama),
            'gambar' => $gambar
        ]);

        return redirect()
            ->route('admin.kategori.index')
            ->with(
                'success',
                'Kategori berhasil ditambahkan'
            );
    }

    // ================= EDIT =================

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view(
            'admin.kategori.edit',
            compact('kategori')
        );
    }

    // ================= UPDATE =================

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $kategori = Kategori::findOrFail($id);

        $gambar = $kategori->gambar;

        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama
            if (
                $kategori->gambar &&
                Storage::disk('public')
                    ->exists($kategori->gambar)
            ) {

                Storage::disk('public')
                    ->delete($kategori->gambar);
            }

            // Upload baru
            $gambar = $request
                ->file('gambar')
                ->store('kategori', 'public');
        }

        $kategori->update([
            'nama'   => $request->nama,
            'slug'   => Str::slug($request->nama),
            'gambar' => $gambar
        ]);

        return redirect()
            ->route('admin.kategori.index')
            ->with(
                'success',
                'Kategori berhasil diupdate'
            );
    }

    // ================= DELETE =================

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        // Hapus gambar
        if (
            $kategori->gambar &&
            Storage::disk('public')
                ->exists($kategori->gambar)
        ) {

            Storage::disk('public')
                ->delete($kategori->gambar);
        }

        $kategori->delete();

        return redirect()
            ->route('admin.kategori.index')
            ->with(
                'success',
                'Kategori berhasil dihapus'
            );
    }
}
