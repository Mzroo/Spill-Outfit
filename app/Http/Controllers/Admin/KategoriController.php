<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
        // =========================================================================
    // CONSTRUCTOR MIDDLEWARE (Satpam Pengaman Sisi Backend)
    // =========================================================================
    public function __construct()
    {
        // Memaksa SELURUH fungsi/method di dalam controller ini wajib lolos 
        // satpam login ('auth') DAN wajib memiliki role admin ('admin')
        $this->middleware(['auth', 'admin']);
    }

    // ================= INDEX (WITH SEARCH & PAGINATION) =================

    public function index(Request $request)
    {
        // 1. Ambil input pencarian dari request query string
        $search = $request->input('search');

        // 2. Buat query dasar
        $query = Kategori::query();

        // 3. Jika ada input search, filter berdasarkan Nama, Kode Kategori, atau Slug
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'LIKE', "%{$search}%")
                  ->orWhere('kode_kategori', 'LIKE', "%{$search}%")
                  ->orWhere('slug', 'LIKE', "%{$search}%");
            });
        }

        // 4. Urutkan dari data terbaru lalu pecah menjadi paginasi (10 data per halaman)
        // appends() digunakan agar saat klik halaman 2, kata kunci pencarian tidak hilang di URL
        $kategori = $query->latest('id')->paginate(10);

        return view('admin.kategori.index', compact('kategori'));
    }

    // ================= CREATE =================

    public function create()
    {
        return view('admin.kategori.create');
    }

    // ================= STORE =================

    public function store(Request $request)
    {
        // Validasi input data dari form tambah
        $request->validate([
            'nama'      => 'required|string|max:255',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi' => 'nullable|string',
            'status'    => 'required|in:aktif,nonaktif'
        ]);

        $gambar = null;

        // Upload gambar jika ada file yang dimasukkan
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('kategori', 'public');
        }

        // Simpan data (kode_kategori akan digenerate otomatis oleh booted() di Model)
        Kategori::create([
            'nama'      => $request->nama,
            'slug'      => Str::slug($request->nama),
            'gambar'    => $gambar,
            'deskripsi' => $request->deskripsi,
            'status'    => $request->status
        ]);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori baru berhasil ditambahkan secara sistem.');
    }

    // ================= EDIT =================

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('admin.kategori.edit', compact('kategori'));
    }

    // ================= UPDATE =================

    public function update(Request $request, $id)
    {
        // Validasi input data dari form edit
        $request->validate([
            'nama'      => 'required|string|max:255',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi' => 'nullable|string',
            'status'    => 'required|in:aktif,nonaktif'
        ]);

        $kategori = Kategori::findOrFail($id);
        $gambar = $kategori->gambar;

        // Jika admin mengunggah file gambar baru
        if ($request->hasFile('gambar')) {

            // Hapus berkas gambar lama di storage jika file fisiknya memang ada
            if ($kategori->gambar && Storage::disk('public')->exists($kategori->gambar)) {
                Storage::disk('public')->delete($kategori->gambar);
            }

            // Simpan berkas gambar baru
            $gambar = $request->file('gambar')->store('kategori', 'public');
        }

        // Update data kategori ke database
        $kategori->update([
            'nama'      => $request->nama,
            'slug'      => Str::slug($request->nama),
            'gambar'    => $gambar,
            'deskripsi' => $request->deskripsi,
            'status'    => $request->status
        ]);

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Data perubahan kategori berhasil diperbarui.');
    }

    // ================= DELETE =================

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        // Hapus aset gambar dari direktori storage sebelum record di database dihapus
        if ($kategori->gambar && Storage::disk('public')->exists($kategori->gambar)) {
            Storage::disk('public')->delete($kategori->gambar);
        }

        $kategori->delete();

        return redirect()
            ->route('admin.kategori.index')
            ->with('success', 'Kategori beserta berkas gambar terkait berhasil dihapus.');
    }
}