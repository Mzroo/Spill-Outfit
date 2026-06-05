<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

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
            $lastUser = User::latest('id')->first();
            $number = $lastUser ? $lastUser->id + 1 : 1;
            $userCode = 'US' . str_pad($number, 3, '0', STR_PAD_LEFT);

            User::create([
                'user_code' => $userCode,
                'name'      => $validated['name'],
                'email'     => $validated['email'],
                'password'  => bcrypt($validated['password']), // Lebih aman di-hash manual di sini jika cast belum aktif
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

            // Proteksi akun non-aktif
            if (isset($user->is_active) && !$user->is_active) {
                Auth::logout();
                return back()->with('error', 'Akun Anda dinonaktifkan.');
            }

            // Proteksi role admin
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

            // Gunakan DB::transaction agar proses pengecekan & pembuatan code aman
            $user = DB::transaction(function () use ($googleUser) {
                $existingUser = User::where('email', $googleUser->getEmail())->first();

                if (!$existingUser) {
                    $lastUser = User::latest('id')->first();
                    $number = $lastUser ? $lastUser->id + 1 : 1;
                    $userCode = 'US' . str_pad($number, 3, '0', STR_PAD_LEFT);

                    return User::create([
                        'user_code' => $userCode,
                        'name'      => $googleUser->getName(),
                        'email'     => $googleUser->getEmail(),
                        'google_id' => $googleUser->getId(),
                        'avatar'    => $googleUser->getAvatar(),
                        'password'  => bcrypt(Str::random(32)), // Hash password random demi keamanan
                        'role'      => 'user',
                        'is_active' => true,
                    ]);
                }

                return $existingUser;
            });

            // --- PERBAIKAN VALIDASI ROLE DAN STATUS UNTUK GOOGLE AUTH ---
            if (isset($user->is_active) && !$user->is_active) {
                return redirect()->route('login')->with('error', 'Akun Anda dinonaktifkan.');
            }

            if ($user->role !== 'user') {
                return redirect()->route('login')->with('error', 'Akun admin tidak dapat login di halaman user.');
            }

            Auth::login($user);
            request()->session()->regenerate(); // Regenerasi session setelah login berhasil

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