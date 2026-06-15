<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Hitung Total Pendapatan Bersih (Hanya dari pesanan yang sukses/lunas)
        $totalPendapatan = Pesanan::whereIn('status', ['dibayar', 'dikirim'])
                            ->sum('total_harga');

        // 2. Hitung Total Pesanan Sukses
        $totalTransaksi = Pesanan::whereIn('status', ['dibayar', 'dikirim'])
                            ->count();

        // 3. Hitung Jumlah Customer Terdaftar (Role user)
        $totalPelanggan = User::where('role', 'user')->count();

        // 4. Ambil Data Transaksi Sukses Terbaru untuk Tabel Laporan
        $riwayatLaporan = Pesanan::with('user')
                            ->whereIn('status', ['dibayar', 'dikirim'])
                            ->latest()
                            ->paginate(10);

        return view('admin.laporan.index', compact(
            'totalPendapatan', 
            'totalTransaksi', 
            'totalPelanggan', 
            'riwayatLaporan'
        ));
    }
}