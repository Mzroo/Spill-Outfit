<?php

namespace App\Http\Controllers;

use App\Models\Komunitas;
use Illuminate\Http\Request;

class KomunitasController extends Controller
{
    // =========================
    // FEED KOMUNITAS
    // =========================

    public function index()
    {
        $komunitas = Komunitas::with('user')
                        ->latest()
                        ->paginate(10);

        return view('users.komunitas.index', compact('komunitas'));
    }

    // =========================
    // STORE POSTINGAN
    // =========================

    public function store(Request $request)
    {
        $request->validate([

            'caption' => 'required',
            'gambar' => 'nullable|image'

        ]);

        $gambar = null;

        if($request->hasFile('gambar')){

            $gambar = $request->file('gambar')
                        ->store('komunitas', 'public');

        }

        Komunitas::create([

            'user_id' => auth()->id(),
            'caption' => $request->caption,
            'gambar' => $gambar

        ]);

        return back()->with('success', 'Postingan berhasil dibuat');
    }
}