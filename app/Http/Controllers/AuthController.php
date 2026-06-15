<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Menggunakan DB Transaction untuk mencegah bentroknya nomor urut 'user_code'
        DB::transaction(function () use ($validated) {
            // 1. Ambil format Bulan (MM) dan Tahun (YY) saat ini
            $bulan = Carbon::now()->format('m'); // Contoh: "06"
            $tahun = Carbon::now()->format('y'); // Contoh: "26"
            $prefix = 'USO' . $bulan . $tahun;  // Hasil: "USO0626"

            // 2. Hitung berapa user yang sudah terdaftar dengan prefix bulan & tahun ini
            $countUserBulanIni = User::where('user_code', 'LIKE', $prefix . '%')->count();
            $number = $countUserBulanIni + 1;

            // 3. Gabungkan menjadi USO + MM + YY + 3 digit nomor urut (contoh: USO0626001)
            $userCode = $prefix . str_pad($number, 3, '0', STR_PAD_LEFT);

            User::create([
                'user_code' => $userCode,
                'name'      => $validated['name'],
                'email'     => $validated['email'],
                'password'  => bcrypt($validated['password']),
                'role'      => 'user',
                'is_active' => true,
            ]);
        });

        return redirect()
            ->route('login')
            ->with('success', 'Register berhasil, silakan login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if (isset($user->is_active) && !$user->is_active) {
                Auth::logout();
                return back()->with('error', 'Akun Anda dinonaktifkan.');
            }

            if ($user->role !== 'user') {
                Auth::logout();
                return back()->with('error', 'Akun admin tidak dapat login di halaman user.');
            }

            return redirect()->route('user.dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = DB::transaction(function () use ($googleUser) {
                $existingUser = User::where('email', $googleUser->getEmail())->first();

                if (!$existingUser) {
                    // Sama seperti register biasa, gunakan format bulan dan tahun saat ini
                    $bulan = Carbon::now()->format('m');
                    $tahun = Carbon::now()->format('y');
                    $prefix = 'USO' . $bulan . $tahun;

                    $countUserBulanIni = User::where('user_code', 'LIKE', $prefix . '%')->count();
                    $number = $countUserBulanIni + 1;

                    $userCode = $prefix . str_pad($number, 3, '0', STR_PAD_LEFT);

                    return User::create([
                        'user_code' => $userCode,
                        'name'      => $googleUser->getName(),
                        'email'     => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar'    => $googleUser->getAvatar(),
                        'password'  => bcrypt(Str::random(32)),
                        'role'      => 'user',
                        'is_active' => true,
                    ]);
                }

                return $existingUser;
            });

            if (isset($user->is_active) && !$user->is_active) {
                return redirect()->route('login')->with('error', 'Akun Anda dinonaktifkan.');
            }

            if ($user->role !== 'user') {
                return redirect()->route('login')->with('error', 'Akun admin tidak dapat login di halaman user.');
            }

            Auth::login($user);
            request()->session()->regenerate();

            return redirect()->route('user.dashboard');

        } catch (\Exception $e) {
            return redirect()
                ->route('login')
                ->with('error', 'Login Google gagal atau dibatalkan.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('guest');
    }
}