<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ===============================
    // HALAMAN LOGIN
    // ===============================
    public function showLogin()
    {
        return view('auth.login');
    }

    // ===============================
    // HALAMAN REGISTER
    // ===============================
    public function showRegister()
    {
        return view('auth.register');
    }

    // ===============================
    // REGISTER USER
    // ===============================
    public function register(Request $request)
    {
        // VALIDASI
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // SIMPAN USER
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user'
        ]);

        // REDIRECT KE LOGIN
        return redirect()
            ->route('login')
            ->with(
                'success',
                'Register berhasil, silakan login.'
            );
    }

    // ===============================
    // LOGIN USER
    // ===============================
    public function login(Request $request)
    {
        // VALIDASI
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // LOGIN
        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // CEK ROLE
            if (Auth::user()->role !== 'user') {

                Auth::logout();

                return back()->with(
                    'error',
                    'Akun admin tidak bisa login di halaman user.'
                );
            }

            // BERHASIL LOGIN
            return redirect()->route('user.dashboard');
        }

        // GAGAL LOGIN
        return back()->with(
            'error',
            'Email atau password salah.'
        );
    }

    // ===============================
    // LOGOUT
    // ===============================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('guest');
    }
}