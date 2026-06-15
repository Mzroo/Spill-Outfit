<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
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

    /**
     * INDEX (Display a listing of the brands with search & pagination)
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $query = Brand::latest('id');

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('nama', 'LIKE', "%{$keyword}%")
                  ->orWhere('kode_brand', 'LIKE', "%{$keyword}%")
                  ->orWhere('slug', 'LIKE', "%{$keyword}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$keyword}%");
            });
        }

        // Variabel tunggal $brand agar langsung klop dengan view index Anda
        $brand = $query->paginate(10)->withQueryString();

        return view('admin.brand.index', compact('brand'));
    }

    /**
     * CREATE
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'logo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Mendukung webp
            'status'    => 'required|in:aktif,nonaktif'
        ]);

        $logo = null;

        // Proses unggah file logo
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('brand', 'public');
        }

        // Cukup kirim field ini saja, 'kode_brand' akan diurus otomatis oleh Model Event!
        Brand::create([
            'nama'      => $request->nama,
            'slug'      => Str::slug($request->nama),
            'logo'      => $logo,
            'deskripsi' => $request->deskripsi,
            'status'    => $request->status,
        ]);

        return redirect()
            ->route('admin.brand.index')
            ->with('success', 'Brand baru berhasil ditambahkan dan kode otomatis telah dibuat.');
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * UPDATE
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'logo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'    => 'required|in:aktif,nonaktif'
        ]);

        $brand = Brand::findOrFail($id);
        $logo = $brand->logo;

        if ($request->hasFile('logo')) {
            // Bersihkan file logo lama dari disk public jika ada
            if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
                Storage::disk('public')->delete($brand->logo);
            }

            $logo = $request->file('logo')->store('brand', 'public');
        }

        $brand->update([
            'nama'      => $request->nama,
            'slug'      => Str::slug($request->nama),
            'logo'      => $logo,
            'deskripsi' => $request->deskripsi,
            'status'    => $request->status,
        ]);

        return redirect()
            ->route('admin.brand.index')
            ->with('success', 'Brand berhasil diupdate');
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return redirect()
            ->route('admin.brand.index')
            ->with('success', 'Brand berhasil dihapus');
    }
}