<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    // List & Pencarian Data User
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $query = User::query();

        if (!empty($keyword)) {
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('email', 'LIKE', "%{$keyword}%")
                  ->orWhere('user_code', 'LIKE', "%{$keyword}%");
            });
        }

        // Tampilkan user dengan urutan terbaru (kecuali akun admin itu sendiri jika ingin disembunyikan)
        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    // Form Tambah User Manual oleh Admin
    public function create()
    {
        return view('admin.users.create');
    }

    // Simpan User Baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,user',
            'is_active'=> 'required|boolean'
        ]);

        DB::transaction(function () use ($request) {
            // Logika format kode: USO + Bulan + Tahun + Nomor Urut
            $bulan = Carbon::now()->format('m');
            $tahun = Carbon::now()->format('y');
            $prefix = 'USO' . $bulan . $tahun;

            $countUserBulanIni = User::where('user_code', 'LIKE', $prefix . '%')->count();
            $number = $countUserBulanIni + 1;
            $userCode = $prefix . str_pad($number, 3, '0', STR_PAD_LEFT);

            User::create([
                'user_code' => $userCode,
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'role'      => $request->role,
                'is_active' => $request->is_active,
            ]);
        });

        return redirect()->route('admin.users.index')
            ->with('success', 'User baru berhasil ditambahkan.');
    }

    // Form Edit User
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update Data User
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|min:6', // Kosongkan jika tidak ingin ganti password
            'role'      => 'required|in:admin,user',
            'is_active' => 'required|boolean'
        ]);

        DB::transaction(function () use ($request, $user) {
            $dataUpdate = [
                'name'      => $request->name,
                'email'     => $request->email,
                'role'      => $request->role,
                'is_active' => $request->is_active,
            ];

            // Jika password diisi, ganti dengan yang baru
            if ($request->filled('password')) {
                $dataUpdate['password'] = bcrypt($request->password);
            }

            $user->update($dataUpdate);
        });

        return redirect()->route('admin.users.index')
            ->with('success', 'Data user berhasil diperbarui.');
    }

    // Hapus User
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Mencegah admin tidak sengaja menghapus akunnya sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang digunakan!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus secara permanen.');
    }

    // Fitur Cepat Aktif/Nonaktifkan lewat tombol status
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 'Status akun ' . $user->name . ' berhasil diubah.');
    }
}