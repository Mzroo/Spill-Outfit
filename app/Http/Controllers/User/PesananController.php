<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\PesananItem;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PesananController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CHECKOUT PAGE
    |--------------------------------------------------------------------------
    */
    public function checkout()
    {
        $keranjang = Keranjang::with(['produk', 'varian'])
            ->where('user_id', Auth::id())
            ->get();

        if ($keranjang->isEmpty()) {
            return back()->with('error', 'Keranjang kosong');
        }

        return view('users.pesanan.checkout', compact('keranjang'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE PESANAN
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'metode_pembayaran' => 'required',
        ]);

        $keranjang = Keranjang::with(['produk', 'varian'])
            ->where('user_id', Auth::id())
            ->get();

        if ($keranjang->isEmpty()) {
            return back()->with('error', 'Keranjang kosong');
        }

        // hitung total
        $total = 0;

        foreach ($keranjang as $item) {
            $harga = $item->varian->harga ?? $item->produk->harga;
            $total += $harga * $item->qty;
        }

        // buat pesanan (HEADER)
        $pesanan = Pesanan::create([
            'user_id' => Auth::id(),
            'kode_pesanan' => 'INV-' . strtoupper(Str::random(8)),
            'nama_penerima' => $request->nama_penerima,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => $total,
            'status' => 'pending',
        ]);

        // pindahkan keranjang ke pesanan_item (DETAIL)
        foreach ($keranjang as $item) {

            $harga = $item->varian->harga ?? $item->produk->harga;
            $subtotal = $harga * $item->qty;

            PesananItem::create([
                'pesanan_id' => $pesanan->id,
                'produk_id' => $item->produk_id,
                'produk_varian_id' => $item->produk_varian_id,

                // snapshot
                'nama_produk' => $item->produk->nama,
                'harga' => $harga,
                'qty' => $item->qty,
                'subtotal' => $subtotal,
            ]);
        }

        // kosongkan keranjang
        Keranjang::where('user_id', Auth::id())->delete();

        return redirect()
            ->route('pesanan.show', $pesanan->id)
            ->with('success', 'Pesanan berhasil dibuat');
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PESANAN
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $pesanan = Pesanan::with(['items', 'items.produk', 'items.varian'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('users.pesanan.detail', compact('pesanan'));
    }

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT PESANAN
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('users.pesanan.index', compact('pesanan'));
    }

}

