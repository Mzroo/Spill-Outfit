<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ukuran;
use Illuminate\Http\Request;

class UkuranController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        $ukuran = Ukuran::orderBy('urutan', 'asc')->latest()->get();

        return view('admin.ukuran.index', compact('ukuran'));
    }

    // ================= CREATE =================
    public function create()
    {
        return view('admin.ukuran.create');
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'kode' => 'required|max:10',
            'keterangan' => 'nullable|max:255',
            'urutan' => 'nullable|integer',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        Ukuran::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
            'urutan' => $request->urutan ?? 0,
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.ukuran.index')
            ->with('success', 'Ukuran berhasil ditambahkan');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $ukuran = Ukuran::findOrFail($id);

        return view('admin.ukuran.edit', compact('ukuran'));
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'kode' => 'required|max:10',
            'keterangan' => 'nullable|max:255',
            'urutan' => 'nullable|integer',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $ukuran = Ukuran::findOrFail($id);

        $ukuran->update([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'keterangan' => $request->keterangan,
            'urutan' => $request->urutan ?? 0,
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.ukuran.index')
            ->with('success', 'Ukuran berhasil diupdate');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $ukuran = Ukuran::findOrFail($id);

        $ukuran->delete();

        return redirect()
            ->route('admin.ukuran.index')
            ->with('success', 'Ukuran berhasil dihapus');
    }
}