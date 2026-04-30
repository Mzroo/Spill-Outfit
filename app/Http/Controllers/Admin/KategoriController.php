<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str as SupportStr;

class KategoriController extends Controller
{
    // INDEX
    public function index(){
        $kategori = Kategori::latest()->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    // CREATE
    public function create(){
        return view('admin.kategori.create');
    }

    // STORE
    public function store(Request $request){
        $request->validate([
            'nama' => 'required'
        ]);

        Kategori::create([
            'nama' => $request->nama,
            'slug' => SupportStr::slug($request->nama),
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    // EDIT
    public function edit($id){
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    // UPDATE
    public function update(Request $request, $id){
        $request->validate([
            'nama' => 'required'
        ]);

        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'nama' => $request->nama,
            'slug' => SupportStr::slug($request->nama),
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    // DELETE
    public function destroy($id){
        Kategori::destroy($id);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}