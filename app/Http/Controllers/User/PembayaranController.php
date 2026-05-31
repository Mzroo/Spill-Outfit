<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FORM UPLOAD PEMBAYARAN
    |--------------------------------------------------------------------------
    */
    public function create($pesanan_id)
    {
        $pesanan = Pesanan::with('items')->findOrFail($pesanan_id);

        // keamanan user
        if ($pesanan->user_id != Auth::id()) {
            abort(403);
        }

        return view('users.pembayaran.create', compact('pesanan'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN PEMBAYARAN (UPLOAD BUKTI)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request, $pesanan_id)
    {
        $request->validate([
            'metode_pembayaran' => 'required',
            'bukti_pembayaran'  => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $pesanan = Pesanan::findOrFail($pesanan_id);

        if ($pesanan->user_id != Auth::id()) {
            abort(403);
        }

        // upload bukti
        $bukti = $request->file('bukti_pembayaran')
            ->store('bukti-pembayaran', 'public');

        // buat kode pembayaran
        $kode = 'PAY-' . now()->format('YmdHis');

        // simpan pembayaran
        Pembayaran::create([
            'pesanan_id'        => $pesanan->id,
            'kode_pembayaran'   => $kode,
            'provider'          => 'manual',
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_bayar'       => $pesanan->total,
            'bukti_pembayaran'  => $bukti,
            'status'            => 'pending',
            'dibayar_pada'      => null
        ]);

        // update status pesanan
        $pesanan->update([
            'status' => 'menunggu_verifikasi'
        ]);

        return redirect()
            ->route('pesanan.show', $pesanan->id)
            ->with('success', 'Pembayaran berhasil dikirim, menunggu verifikasi admin');
    }
}