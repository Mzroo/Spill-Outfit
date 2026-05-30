<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warna;
use Illuminate\Http\Request;

class WarnaController extends Controller
{
    /**
     * INDEX
     */
    public function index()
    {
        $warna = Warna::latest()->get();

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
            'nama' => 'required|string|max:100',
            'kode_warna' => 'required|string|max:20',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Warna::create([
            'nama' => $request->nama,
            'kode_warna' => $request->kode_warna,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.warna.index')
            ->with('success', 'Warna berhasil ditambahkan');
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
            'nama' => 'required|string|max:100',
            'kode_warna' => 'required|string|max:20',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $warna = Warna::findOrFail($id);

        $warna->update([
            'nama' => $request->nama,
            'kode_warna' => $request->kode_warna,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.warna.index')
            ->with('success', 'Warna berhasil diupdate');
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        Warna::destroy($id);

        return redirect()->route('admin.warna.index')
            ->with('success', 'Warna berhasil dihapus');
    }
}