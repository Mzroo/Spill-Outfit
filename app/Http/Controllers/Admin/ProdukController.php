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
    // CONSTRUCTOR MIDDLEWARE (Satpam Pengaman Sisi Backend)
    // =========================================================================
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    // =========================================================================
    // 1. INDEX (Menampilkan List Produk Utama + Fitur Search & Pagination)
    // =========================================================================
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $query = Produk::with(['kategori', 'brand', 'varian']);

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('nama', 'LIKE', "%{$keyword}%")
                  ->orWhere('kode', 'LIKE', "%{$keyword}%");
            });
        }

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
        $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategori,id',
            'brand_id'    => 'nullable|exists:brand,id',
            'harga'       => 'required|numeric|min:0',
            'status'      => 'required|in:public,block',
            'gambar'      => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'deskripsi'   => 'nullable|string'
        ]);

        $produk = DB::transaction(function () use ($request) {
            // Pemanggilan generate kode PSO tetap berjalan otomatis di sini
            $kodeOtomatis = $this->generateKodeOtomatis($request->kategori_id, $request->brand_id);

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
            
            if ($request->hasFile('gambar')) {
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
            
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }

            $produk->delete();
        });

        return redirect()->route('admin.produk.index')
            ->with('success', 'Produk beserta seluruh variannya berhasil dihapus.');
    }

    // =========================================================================
    // 7. PRIVATE HELPER (Membentuk Kode Produk Otomatis: PSO-0001)
    // =========================================================================
    private function generateKodeOtomatis($kategoriId, $brandId)
    {
        $prefix = 'PSO';

        $produkTerakhir = Produk::where('kode', 'LIKE', $prefix . '-%')
                            ->latest('id')
                            ->first();

        if ($produkTerakhir) {
            $nomorTerakhir = (int) substr($produkTerakhir->kode, 4);
            $nomorUrut = $nomorTerakhir + 1;
        } else {
            $nomorUrut = 1;
        }

        return $prefix . '-' . str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);
    }
}