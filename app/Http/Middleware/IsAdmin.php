<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah ada user yang sedang login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // --- MASUKKAN KODE SEMENTARA INI UNTUK TRACING ---
        // Pengecekan ini akan menghentikan aplikasi dan menampilkan data role user yang sedang aktif
        // dd(Auth::user()->role); 
        // ------------------------------------------------

        // 2. Gunakan strtolower() agar tidak sensitif terhadap huruf besar/kecil
        if (strtolower(Auth::user()->role) !== 'admin') {
            return redirect()->route('user.dashboard')->with('error', 'Akses ditolak! Anda bukan admin.');
        }

        return $next($request);
    }
}