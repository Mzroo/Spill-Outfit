<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// IMPORT MODEL DATABASE
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\User;
use App\Models\ProdukVarian; // Sesuaikan jika nama model varian Anda berbeda

class AdminController extends Controller
{
    /**
     * CONSTRUCTOR MIDDLEWARE
     * Ini adalah satpam internal di dalam Controller.
     */
    public function __construct()
    {
        // Fungsi dashboard dan logout WAJIB melewati satpam login (auth) dan role admin (admin)
        $this->middleware(['auth', 'admin'])->except(['login', 'loginPost']);
    }

    // ================= DASHBOARD DINAMIS DATABASE =================
    public function dashboard()
    {
        // 1. Matriks Alur Pengiriman Logistik (Berdasarkan Status Pesanan)
        $perluDikemas = Pesanan::where('status', 'dibayar')->count();
        $sedangDikirim = Pesanan::where('status', 'dikirim')->count();
        $pesananSelesai = Pesanan::where('status', 'selesai')->count(); 

        // 2. Angka Akumulasi Statistik Utama (Stat Cards)
        $totalProduk = Produk::count();
        $totalPesanan = Pesanan::count();
        $totalCustomer = User::where('role', 'user')->count();
        
        // Pendapatan dihitung dari pesanan yang sudah lunas/berjalan sukses
        $totalPendapatan = Pesanan::whereIn('status', ['dibayar', 'dikirim', 'selesai'])->sum('total_harga');

        // 3. Mengambil 5 Transaksi / Pesanan Masuk Terbaru (Eager Loading User)
        $pesananTerbaru = Pesanan::with('user')->latest()->limit(5)->get();

        // 4. Mengambil Produk Stok Menipis (Sisa <= 5 Pcs dan stok tidak kosong)
        $stokMenipis = [];
        if (class_exists('App\Models\ProdukVarian')) {
            $stokMenipis = ProdukVarian::with(['produk', 'warna', 'ukuran'])
                ->where('stok', '<=', 5)
                ->where('stok', '>', 0)
                ->limit(4)
                ->get();
        }

        // Lempar semua variabel ke view admin.dashboard
        return view('admin.dashboard', compact(
            'perluDikemas',
            'sedangDikirim',
            'pesananSelesai',
            'totalProduk',
            'totalPesanan',
            'totalCustomer',
            'totalPendapatan',
            'pesananTerbaru',
            'stokMenipis'
        ));
    }

    // ================= HALAMAN LOGIN =================
    public function login()
    {
        // Jika admin sudah terlanjur login, jangan kasih lihat halaman login lagi, lempar ke dashboard
        if (Auth::check() && strtolower(Auth::user()->role) === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login_admin');
    }

    // ================= PROSES LOGIN =================
    public function loginPost(Request $request)
    {
        // VALIDASI
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // CEK LOGIN
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            // CEK ROLE (Gunakan strtolower agar tidak sensitif huruf besar/kecil)
            if (strtolower(Auth::user()->role) !== 'admin') {
                Auth::logout();
                return back()->with('error', 'Akun ini bukan admin');
            }

            // LOGIN BERHASIL - Regenerasi session demi keamanan
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        // LOGIN GAGAL
        return back()->with('error', 'Email atau password salah');
    }

    // ================= LOGOUT =================
    public function logout(Request $request) 
    {
        Auth::logout();

        // Hancurkan session admin agar bersih total
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}