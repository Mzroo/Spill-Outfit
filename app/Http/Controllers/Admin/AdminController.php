<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // ================= DASHBOARD =================
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // ================= HALAMAN LOGIN =================
    public function login()
    {
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

            // CEK ROLE
            if (Auth::user()->role !== 'admin') {

                Auth::logout();

                return back()->with(
                    'error',
                    'Akun ini bukan admin'
                );
            }

            // LOGIN BERHASIL
            return redirect()->route('admin.dashboard');
        }

        // LOGIN GAGAL
        return back()->with(
            'error',
            'Email atau password salah'
        );
    }

    // ================= LOGOUT =================
    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
}