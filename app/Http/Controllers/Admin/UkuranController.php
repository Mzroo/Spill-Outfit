<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ukuran;
use Illuminate\Http\Request;

class UkuranController extends Controller
{
    /**
     * Display a listing of the sizes with search and pagination.
     */
    public function index(Request $request)
    {
        // Tangkap kata kunci pencarian dari input text name="search"
        $keyword = $request->get('search');

        // Query dasar diurutkan berdasarkan kolom 'urutan' agar S, M, L, XL berurutan rapi
        $query = Ukuran::orderBy('urutan', 'asc');

        // Eksekusi filter jika admin melakukan pencarian
        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('nama', 'LIKE', "%{$keyword}%")
                  ->orWhere('kode', 'LIKE', "%{$keyword}%")
                  ->orWhere('keterangan', 'LIKE', "%{$keyword}%");
            });
        }

        // Batasi 10 data per halaman & kunci parameter pencarian di URL saat pindah halaman
        $ukuran = $query->paginate(10)->withQueryString();

        return view('admin.ukuran.index', compact('ukuran'));
    }

    /**
     * Show the form for creating a new size.
     */
    public function create()
    {
        return view('admin.ukuran.create');
    }

    /**
     * Store a newly created size in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'kode'    => 'required|string|max:50|unique:ukuran,kode',
            'urutan'  => 'required|integer|min:1',
            'status'  => 'required|in:aktif,nonaktif',
        ]);

        Ukuran::create([
            'nama'       => $request->nama,
            'kode'       => strtoupper($request->kode), // Otomatis kapital (ex: XL, XXL)
            'keterangan' => $request->keterangan,
            'urutan'     => $request->urutan,
            'status'     => $request->status,
        ]);

        return redirect()
            ->route('admin.ukuran.index')
            ->with('success', 'Data ukuran baru berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified size.
     */
    public function edit($id)
    {
        $ukuran = Ukuran::findOrFail($id);

        return view('admin.ukuran.edit', compact('ukuran'));
    }

    /**
     * Update the specified size in storage.
     */
    public function update(Request $request, $id)
    {
        $ukuran = Ukuran::findOrFail($id);

        $request->validate([
            'nama'    => 'required|string|max:255',
            'kode'    => 'required|string|max:50|unique:ukuran,kode,' . $id,
            'urutan'  => 'required|integer|min:1',
            'status'  => 'required|in:aktif,nonaktif',
        ]);

        $ukuran->update([
            'nama'       => $request->nama,
            'kode'       => strtoupper($request->kode),
            'keterangan' => $request->keterangan,
            'urutan'     => $request->urutan,
            'status'     => $request->status,
        ]);

        return redirect()
            ->route('admin.ukuran.index')
            ->with('success', 'Data perubahan ukuran berhasil diperbarui.');
    }

    /**
     * Remove the specified size from storage.
     */
    public function destroy($id)
    {
        $ukuran = Ukuran::findOrFail($id);
        $ukuran->delete();

        return redirect()
            ->route('admin.ukuran.index')
            ->with('success', 'Data ukuran telah berhasil dihapus dari sistem.');
    }
}