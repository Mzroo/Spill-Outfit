<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminPesananController extends Controller
{
    /**
     * DISPLAY ALL ORDERS (Halaman Utama Transaksi)
     * Menampilkan semua daftar pesanan masuk dilengkapi dengan filter status.
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        
        // FIX: Menggunakan relasi 'items' sesuai yang terdaftar di model Pesanan.php
        $query = Pesanan::with(['user', 'items']);

        // Jika admin memilih filter status tertentu (e.g., pending, dibayar, dikirim)
        if (!empty($status)) {
            $query->where('status', $status);
        }

        // Ambil data terbaru, batasi 10 data per halaman, dan amankan query string URL
        $pesanan = $query->latest()->paginate(10)->withQueryString();

        return view('admin.pesanan.index', compact('pesanan'));
    }

    /**
     * DISPLAY DETAIL ORDER (Halaman Detail Invoice)
     * Melihat rincian barang belanjaan, data pelanggan, dan logistik pengiriman.
     */
    public function show($id)
    {
        // FIX MASTER: Mengubah 'detailPesanan.produk' menjadi 'items.produk' 
        // agar selaras dengan fungsi public function items() di model Pesanan.php Anda.
        $pesanan = Pesanan::with(['user', 'items.produk'])->findOrFail($id);
        
        return view('admin.pesanan.show', compact('pesanan'));
    }

    /**
     * UPDATE SHIPPING RESI (Proses Input Nomor Resi Kurir)
     * Mengubah status pesanan dari 'dibayar' menjadi 'dikirim' sekaligus menyimpan nomor resi.
     */
    public function kirimPesanan(Request $request, $id)
    {
        // Validasi input nomor resi kurir
        $request->validate([
            'nomor_resi' => 'required|string|max:100',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        // Validasi status: Hanya pesanan yang sudah lunas (dibayar) yang boleh dikirim resinya
        if ($pesanan->status !== 'dibayar') {
            return back()->with('error', 'Pesanan gagal diproses. Status saat ini belum dibayar atau sudah diproses sebelumnya.');
        }

        // Amankan proses update menggunakan Database Transaction
        DB::transaction(function () use ($request, $pesanan) {
            $pesanan->update([
                'nomor_resi' => $request->nomor_resi,
                'status'     => 'dikirim'
            ]);
        });

        return redirect()->route('admin.pesanan.index', ['status' => 'dikirim'])
            ->with('success', 'Nomor resi berhasil diinput. Status pesanan kini beralih menjadi Sedang Dikirim!');
    }
}