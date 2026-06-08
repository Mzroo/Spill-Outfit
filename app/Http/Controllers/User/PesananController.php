<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TarifPengiriman;
use App\Models\Pesanan;
use App\Models\PesananItem;
use App\Models\Keranjang;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PesananController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INTERNAL AJAX API FOR CITY/ZIP SEARCH
    |--------------------------------------------------------------------------
    */
    public function searchCity(Request $request)
    {
        $keyword = $request->search;

        // DIUBAH: Sekarang pencarian juga mendukung pencarian via nomor kode pos di tabel tarif_pengiriman
        $tarifPengiriman = TarifPengiriman::where('kota', 'LIKE', "%{$keyword}%")
                                        ->orWhere('provinsi', 'LIKE', "%{$keyword}%")
                                        ->orWhere('kode_pos', 'LIKE', "%{$keyword}%")
                                        ->limit(10)
                                        ->get();

        $data = $tarifPengiriman->map(function($item) {
            // Gabungkan kode pos ke dalam label jika tersedia di database tarif
            $labelOpsi = $item->kota . ', ' . $item->provinsi;
            if ($item->kode_pos) {
                $labelOpsi .= ' (' . $item->kode_pos . ')';
            }

            return [
                'id'        => $item->id,
                'label'     => $labelOpsi,
                'base_cost' => $item->base_cost
            ];
        });

        return response()->json([
            'status' => true,
            'data'   => $data
        ]);
    }

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
                ->with('error', 'Keranjang kosong');
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
            'courier' => 'required',
            'ongkir'  => 'required|numeric|min:0',
        ]);

        $user = Auth::user();

        $keranjang = Keranjang::with(['produk', 'varian'])
            ->where('user_id', $user->id)
            ->get();

        if ($keranjang->isEmpty()) {
            return back()->with('error', 'Keranjang kosong');
        }

        DB::beginTransaction();
        try {
            // Hitung Subtotal
            $subtotal = 0;
            foreach ($keranjang as $item) {
                $harga = $item->varian->harga ?? $item->produk->harga;
                $subtotal += $harga * $item->qty;
            }

            $ongkir     = $request->ongkir;
            $totalHarga = $subtotal + $ongkir;

            // Buat Master Pesanan
            $pesanan = Pesanan::create([
                'user_id'           => $user->id,
                'kode_pesanan'      => 'INV-' . strtoupper(Str::random(10)),
                'catatan'           => $request->catatan,
                'subtotal'          => $subtotal,
                'ongkir'            => $ongkir,
                'total_harga'       => $totalHarga,
                'metode_pembayaran' => $request->metode_pembayaran ?? 'midtrans',
                'status'            => 'unpaid',
            ]);

            // Pindahkan Item ke Pesanan Item
            foreach ($keranjang as $item) {
                $harga = $item->varian->harga ?? $item->produk->harga;
                $subtotalItem = $harga * $item->qty;

                $namaVarian = null;
                if ($item->varian) {
                    $kodeUkuran = $item->varian->ukuran->nama ?? ''; 
                    $namaWarna  = $item->varian->warna->nama ?? '';
                    $namaVarian = trim($kodeUkuran . ' - ' . $namaWarna, ' - ');
                }

                PesananItem::create([
                    'pesanan_id'       => $pesanan->id,
                    'produk_id'        => $item->produk_id,
                    'produk_varian_id' => $item->produk_varian_id,
                    'nama_produk'      => $item->produk->nama,
                    'nama_varian'      => $namaVarian,
                    'gambar'           => $item->produk->gambar,
                    'harga'            => $harga,
                    'qty'              => $item->qty,
                    'subtotal'         => $subtotalItem,
                ]);
            }

            // AMBIL SNAP TOKEN SEKALIGUS UNTUK DISIMPAN DI DATABASE (REKOMENDASI)
            try {
                $midtrans = new MidtransService();
                $snapToken = $midtrans->createSnapToken($pesanan, $pesanan->items, $pesanan->ongkir, $user);
                $pesanan->update(['snap_token' => $snapToken]);
            } catch (\Exception $me) {
                // Jika Midtrans gagal/down, transaksi lokal database tetap berhasil dibuat
                Log::error('Midtrans Token Creation Failed: ' . $me->getMessage());
            }

            // Kosongkan Keranjang
            Keranjang::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()
                ->route('pesanan.show', $pesanan->id)
                ->with('success', 'Pesanan berhasil dibuat');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL PESANAN & PEMICU PEMBAYARAN
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $user = Auth::user();
        
        $pesanan = Pesanan::with(['items']) // Cukup load items snapshot saja
            ->where('user_id', $user->id)
            ->findOrFail($id);

        $snapToken = $pesanan->snap_token;

        // Backup plan: Jika saat store() gagal mendapat token, kita generate ulang di sini
        if ($pesanan->status === 'unpaid' && !$snapToken) {
            try {
                $midtrans = new MidtransService();
                $snapToken = $midtrans->createSnapToken($pesanan, $pesanan->items, $pesanan->ongkir, $user);
                $pesanan->update(['snap_token' => $snapToken]);
            } catch (\Exception $e) {
                Log::error('Midtrans Show Generate Failed: ' . $e->getMessage());
            }
        }

        return view('users.pesanan.detail', compact('pesanan', 'snapToken'));
    }

    /*
    |--------------------------------------------------------------------------
    | RIWAYAT PESANAN
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        // Menambahkan with('items') untuk mencegah N+1 Query bug pada index blade
        $pesanan = Pesanan::with('items')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('users.pesanan.index', compact('pesanan'));
    }
}