<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    // =========================================================================
    // 1. INDEX (Menampilkan List Produk Utama + Fitur Search & Pagination)
    // =========================================================================
    public function index(Request $request)
    {
        // Mengambil keyword pencarian dari input nama="search" di form blade
        $keyword = $request->get('search');

        // Eager loading relasi kategori, brand, dan varian (untuk hitung total_stok via accessor)
        $query = Produk::with(['kategori', 'brand', 'varian']);

        // Logika Kondisional jika user melakukan pencarian
        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('nama', 'LIKE', "%{$keyword}%")
                  ->orWhere('kode', 'LIKE', "%{$keyword}%");
            });
        }

        // Urutkan dari yang terbaru, batasi 10 data per halaman
        // withQueryString() berguna agar parameter ?search=... tidak hilang saat klik tombol next page
        $produk = $query->latest()->paginate(10)->withQueryString();

        return view('admin.produk.index', compact('produk'));
    }

    // =========================================================================
    // 2. CREATE (Menampilkan Form Tambah Produk Utama)
    // =========================================================================
    public function create()
    {
        $kategori = Kategori::all();
        $brand = Brand::all();
        
        return view('admin.produk.create', compact('kategori', 'brand'));
    }

    // =========================================================================
    // 3. STORE (Menyimpan Data Produk Utama & Auto-Generate Kode)
    // =========================================================================
    public function store(Request $request)
    {
        // Validasi ketat data produk utama (tanpa input stok karena dilempar ke varian)
        $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'brand_id'    => 'nullable|exists:brand,id',
            'harga'       => 'required|numeric|min:0',
            'status'      => 'required|in:public,block',
            'gambar'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi'   => 'nullable|string'
        ]);

        // Gunakan DB Transaction untuk memastikan keamanan data
        $produk = DB::transaction(function () use ($request) {
            // Generate kode otomatis berdasarkan kategori dan brand
            $kodeOtomatis = $this->generateKodeOtomatis($request->kategori_id, $request->brand_id);

            // Upload berkas gambar ke folder storage/app/public/produk
            $gambar = null;
            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar')->store('produk', 'public');
            }

            return Produk::create([
                'kode'        => $kodeOtomatis,
                'nama'        => $request->nama,
                'kategori_id' => $request->kategori_id,
                'brand_id'    => $request->brand_id,
                'harga'       => $request->harga,
                'status'      => $request->status,
                'deskripsi'   => $request->deskripsi,
                'gambar'      => $gambar,
            ]);
        });

        // Alihkan langsung ke halaman manajemen varian bawaan produk tersebut
        return redirect()->route('admin.produk-varian.index', ['produk_id' => $produk->id])
            ->with('success', 'Produk utama berhasil dibuat! Silakan tentukan kombinasi varian warna, ukuran, dan stoknya di sini.');
    }

    // =========================================================================
    // 4. EDIT (Menampilkan Form Edit Data Produk Utama)
    // =========================================================================
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::all();
        $brand = Brand::all();
        
        return view('admin.produk.edit', compact('produk', 'kategori', 'brand'));
    }

    // =========================================================================
    // 5. UPDATE (Memperbarui Data Produk Utama)
    // =========================================================================
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'brand_id'    => 'nullable|exists:brand,id',
            'harga'       => 'required|numeric|min:0',
            'status'      => 'required|in:public,block',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi'   => 'nullable|string'
        ]);

        DB::transaction(function () use ($request, $produk) {
            $gambar = $produk->gambar;
            
            // Jika ada file gambar baru yang diunggah
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama dari berkas storage jika eksis
                if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                    Storage::disk('public')->delete($produk->gambar);
                }
                $gambar = $request->file('gambar')->store('produk', 'public');
            }

            $produk->update([
                'nama'        => $request->nama,
                'kategori_id' => $request->kategori_id,
                'brand_id'    => $request->brand_id,
                'harga'       => $request->harga,
                'status'      => $request->status,
                'deskripsi'   => $request->deskripsi,
                'gambar'      => $gambar,
            ]);
        });

        return redirect()->route('admin.produk.index')
            ->with('success', 'Data produk utama berhasil diperbarui.');
    }

    // =========================================================================
    // 6. DESTROY (Menghapus Produk Utama beserta Gambarnya)
    // =========================================================================
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $produk = Produk::findOrFail($id);
            
            // Hapus gambar fisik
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }

            // Hapus baris data produk utama
            // Catatan: Karena di migration kamu memakai ->cascadeOnDelete() pada foreign key produk_id,
            // semua data varian yang terikat di tabel 'produk_varian' otomatis terhapus bersih oleh database.
            $produk->delete();
        });

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk beserta seluruh variannya berhasil dihapus.');
    }

    // =========================================================================
    // 7. PRIVATE HELPER (Membentuk Kode Produk Otomatis)
    // =========================================================================
    private function generateKodeOtomatis($kategoriId, $brandId)
    {
        $kategori = Kategori::find($kategoriId);
        $hurufKategori = $kategori ? strtoupper(substr($kategori->nama, 0, 1)) : 'X';

        $brand = Brand::find($brandId);
        $hurufBrand = $brand ? strtoupper(substr($brand->nama, 0, 1)) : 'G';

        $prefix = $hurufKategori . $hurufBrand;

        $produkTerakhir = Produk::where('kode', 'LIKE', $prefix . '-%')
                            ->latest('id')
                            ->first();

        $nomorUrut = $produkTerakhir ? (int) substr($produkTerakhir->kode, strpos($produkTerakhir->kode, '-') + 1) + 1 : 1;

        return $prefix . '-' . str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);
    }
}