<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warna;
use Illuminate\Http\Request;

class WarnaController extends Controller
{
    /**
     * INDEX (Display with search & pagination)
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $query = Warna::latest('id');

        // Logika pencarian multi-kolom
        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('nama', 'LIKE', "%{$keyword}%")
                  ->orWhere('kode_warna', 'LIKE', "%{$keyword}%")
                  ->orWhere('status', 'LIKE', "%{$keyword}%");
            });
        }

        // Paginate 10 data per halaman
        $warna = $query->paginate(10)->withQueryString();

        return view('admin.warna.index', compact('warna'));
    }

    /**
     * CREATE
     */
    public function create()
    {
        return view('admin.warna.create');
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'kode_warna' => 'nullable|string|max:7', // Membatasi panjang karakter HEX (ex: #FF0000)
            'status'     => 'required|in:aktif,nonaktif'
        ]);

        Warna::create([
            'nama'       => $request->nama,
            'kode_warna' => $request->kode_warna,
            'status'     => $request->status,
        ]);

        return redirect()
            ->route('admin.warna.index')
            ->with('success', 'Warna baru berhasil ditambahkan.');
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        $warna = Warna::findOrFail($id);
        return view('admin.warna.edit', compact('warna'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'kode_warna' => 'nullable|string|max:7',
            'status'     => 'required|in:aktif,nonaktif'
        ]);

        $warna = Warna::findOrFail($id);
        $warna->update([
            'nama'       => $request->nama,
            'kode_warna' => $request->kode_warna,
            'status'     => $request->status,
        ]);

        return redirect()
            ->route('admin.warna.index')
            ->with('success', 'Data warna berhasil diperbarui.');
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        $warna = Warna::findOrFail($id);
        $warna->delete();

        return redirect()
            ->route('admin.warna.index')
            ->with('success', 'Warna berhasil dihapus dari sistem.');
    }
}