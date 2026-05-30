<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST KERANJANG
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $keranjang = Keranjang::with([
            'produk.kategori',
            'varian.warna',
            'varian.ukuran'
        ])
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

        return view(
            'users.keranjang.index',
            compact('keranjang')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH KE KERANJANG
    |--------------------------------------------------------------------------
    */
    public function store(Request $request, $id)
    {
        $request->validate([
            'produk_varian_id' =>
                'required|exists:produk_varian,id',

            'qty' =>
                'required|integer|min:1'
        ]);

        // ambil produk
        $produk = Produk::with('varian')
            ->findOrFail($id);

        // ambil varian berdasarkan id
        $varian = $produk->varian()
            ->where(
                'id',
                $request->produk_varian_id
            )
            ->first();

        if (!$varian) {

            return back()->with(
                'error',
                'Varian tidak ditemukan'
            );
        }

        // stok habis
        if ($varian->stok <= 0) {

            return back()->with(
                'error',
                'Stok habis'
            );
        }

        // qty melebihi stok
        if ($request->qty > $varian->stok) {

            return back()->with(
                'error',
                'Jumlah melebihi stok'
            );
        }

        // cek sudah ada di keranjang?
        $cek = Keranjang::where(
                'user_id',
                Auth::id()
            )
            ->where(
                'produk_id',
                $produk->id
            )
            ->where(
                'produk_varian_id',
                $varian->id
            )
            ->first();

        // kalau sudah ada → tambah qty
        if ($cek) {

            $newQty =
                $cek->qty +
                $request->qty;

            if (
                $newQty >
                $varian->stok
            ) {

                return back()->with(
                    'error',
                    'Jumlah melebihi stok'
                );
            }

            $cek->update([
                'qty' => $newQty
            ]);

        } else {

            // simpan baru
            Keranjang::create([
                'user_id' =>
                    Auth::id(),

                'produk_id' =>
                    $produk->id,

                'produk_varian_id' =>
                    $varian->id,

                'qty' =>
                    $request->qty
            ]);
        }

        return redirect()
            ->route('keranjang.index')
            ->with(
                'success',
                'Produk masuk keranjang'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE QTY
    |--------------------------------------------------------------------------
    */
    public function updateQty(
        Request $request,
        $id
    )
    {
        $item = Keranjang::with('varian')
            ->findOrFail($id);

        // keamanan user
        if (
            $item->user_id !=
            Auth::id()
        ) {
            abort(403);
        }

        // tambah
        if (
            $request->action == 'plus'
        ) {

            if (
                $item->qty <
                $item->varian->stok
            ) {

                $item->increment(
                    'qty'
                );
            }
        }

        // kurang
        if (
            $request->action == 'minus'
        ) {

            if (
                $item->qty > 1
            ) {

                $item->decrement(
                    'qty'
                );
            }
        }

        return back()->with(
            'success',
            'Jumlah diperbarui'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS ITEM
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $keranjang =
            Keranjang::findOrFail($id);

        // keamanan user
        if (
            $keranjang->user_id
            != Auth::id()
        ) {

            abort(403);
        }

        $keranjang->delete();

        return back()->with(
            'success',
            'Produk dihapus'
        );
    }
}