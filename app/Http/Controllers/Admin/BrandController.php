<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * INDEX
     */
    public function index()
    {
        $brands = Brand::latest()->get();

        return view(
            'admin.brand.index',
            compact('brands')
        );
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
            'nama' => 'required|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required'
        ]);

        $logo = null;

        // upload logo
        if ($request->hasFile('logo')) {

            $logo = $request
                ->file('logo')
                ->store('brand', 'public');
        }

        Brand::create([

            'nama' => $request->nama,

            'slug' => Str::slug($request->nama),

            'logo' => $logo,

            'deskripsi' => $request->deskripsi,

            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.brand.index')
            ->with(
                'success',
                'Brand berhasil ditambahkan'
            );
    }

    /**
     * EDIT
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view(
            'admin.brand.edit',
            compact('brand')
        );
    }

    /**
     * UPDATE
     */
    public function update(
        Request $request,
        $id
    ) {

        $request->validate([
            'nama' => 'required|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required'
        ]);

        $brand =
            Brand::findOrFail($id);

        $logo =
            $brand->logo;

        // jika upload baru
        if ($request->hasFile('logo')) {

            // hapus logo lama
            if (
                $brand->logo &&
                Storage::disk('public')
                    ->exists($brand->logo)
            ) {

                Storage::disk('public')
                    ->delete($brand->logo);
            }

            $logo = $request
                ->file('logo')
                ->store('brand', 'public');
        }

        $brand->update([

            'nama' => $request->nama,

            'slug' =>
                Str::slug($request->nama),

            'logo' => $logo,

            'deskripsi' =>
                $request->deskripsi,

            'status' =>
                $request->status,
        ]);

        return redirect()
            ->route('admin.brand.index')
            ->with(
                'success',
                'Brand berhasil diupdate'
            );
    }

    /**
     * DELETE
     */
    public function destroy($id)
    {
        $brand =
            Brand::findOrFail($id);

        // hapus logo
        if (
            $brand->logo &&
            Storage::disk('public')
                ->exists($brand->logo)
        ) {

            Storage::disk('public')
                ->delete($brand->logo);
        }

        $brand->delete();

        return redirect()
            ->route('admin.brand.index')
            ->with(
                'success',
                'Brand berhasil dihapus'
            );
    }
}