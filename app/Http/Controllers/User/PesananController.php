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
        $keranjang = Keranjang::with([
            'produk',
            'varian'
        ])
        ->where('user_id', Auth::id())
        ->get();

        if ($keranjang->isEmpty()) {

            return redirect()
                ->route('keranjang.index')
                ->with(
                    'error',
                    'Keranjang kosong'
                );
        }

        return view(
            'users.pesanan.checkout',
            compact('keranjang')
        );
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

            'provinsi' => 'nullable',

            'kota' => 'nullable',

            'kode_pos' => 'nullable',

            'courier' => 'nullable',

            'metode_pembayaran' => 'required',

        ]);

        $keranjang = Keranjang::with([
            'produk',
            'varian'
        ])
        ->where('user_id', Auth::id())
        ->get();

        if ($keranjang->isEmpty()) {

            return back()->with(
                'error',
                'Keranjang kosong'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | HITUNG SUBTOTAL
        |--------------------------------------------------------------------------
        */

        $subtotal = 0;

        foreach ($keranjang as $item) {

            $harga =
                $item->varian->harga
                ?? $item->produk->harga;

            $subtotal +=
                $harga * $item->qty;
        }

        /*
        |--------------------------------------------------------------------------
        | ONGKIR
        |--------------------------------------------------------------------------
        */

        $ongkir =
            $request->ongkir ?? 0;

        $totalHarga =
            $subtotal + $ongkir;

        /*
        |--------------------------------------------------------------------------
        | BUAT PESANAN
        |--------------------------------------------------------------------------
        */

        $pesanan = Pesanan::create([

            'user_id' =>
                Auth::id(),

            'kode_pesanan' =>
                'INV-' . strtoupper(
                    Str::random(10)
                ),

            'nama_penerima' =>
                $request->nama_penerima,

            'no_hp' =>
                $request->no_hp,

            'provinsi' =>
                $request->provinsi,

            'kota' =>
                $request->kota,

            'alamat' =>
                $request->alamat,

            'kode_pos' =>
                $request->kode_pos,

            'catatan' =>
                $request->catatan,

            'destination_id' =>
                $request->destination_id,

            'courier' =>
                $request->courier,

            'subtotal' =>
                $subtotal,

            'ongkir' =>
                $ongkir,

            'total_harga' =>
                $totalHarga,

            'metode_pembayaran' =>
                $request->metode_pembayaran,

            'status' =>
                'unpaid',

        ]);

        /*
        |--------------------------------------------------------------------------
        | PINDAHKAN KE PESANAN ITEM
        |--------------------------------------------------------------------------
        */

        foreach ($keranjang as $item) {

            $harga =
                $item->varian->harga
                ?? $item->produk->harga;

            $subtotalItem =
                $harga * $item->qty;

            PesananItem::create([

                'pesanan_id' =>
                    $pesanan->id,

                'produk_id' =>
                    $item->produk_id,

                'produk_varian_id' =>
                    $item->produk_varian_id,

                'nama_produk' =>
                    $item->produk->nama,

                'nama_varian' =>
                    $item->varian?->nama,

                'gambar' =>
                    $item->produk->gambar,

                'harga' =>
                    $harga,

                'qty' =>
                    $item->qty,

                'subtotal' =>
                    $subtotalItem,

            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | KOSONGKAN KERANJANG
        |--------------------------------------------------------------------------
        */

        Keranjang::where(
            'user_id',
            Auth::id()
        )->delete();

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'pesanan.show',
                $pesanan->id
            )
            ->with(
                'success',
                'Pesanan berhasil dibuat'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PESANAN
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $pesanan = Pesanan::with([

            'items',

            'items.produk',

            'items.varian'

        ])
        ->where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view(
            'users.pesanan.detail',
            compact('pesanan')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT PESANAN
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $pesanan = Pesanan::where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->get();

        return view(
            'users.pesanan.index',
            compact('pesanan')
        );
    }
}