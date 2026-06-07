<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CommunityPost;
use App\Models\Produk; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (DASHBOARD USER)
    |--------------------------------------------------------------------------
    | Menampilkan halaman depan dashboard user beserta 3 postingan terbaru
    | dari komunitas yang statusnya sudah 'published'.
    |
    */
    public function index()
    {
        // Mengambil 3 data postingan terbaru.
        // Eager loading diarahkan langsung ke 'user' (tanpa .profile) karena tabel profile sudah dihapus.
        $posts = CommunityPost::with(['user'])
                    ->where('status', 'published')
                    ->latest()
                    ->take(3) // Batasi hanya 3 data agar pas dengan grid col-lg-4
                    ->get();

        // Kirim variabel $posts ke file blade utama Anda
        return view('users.dashboard', compact('posts'));
    }

    /*
    |--------------------------------------------------------------------------
    | ABOUT
    |--------------------------------------------------------------------------
    | Menampilkan halaman informasi/tentang aplikasi toko bunga.
    |
    */
    public function about()
    {
        return view('users.about.index');
    }

    /*
    |--------------------------------------------------------------------------
    | SETTINGS (HALAMAN EDIT PROFILE)
    |--------------------------------------------------------------------------
    | Menampilkan form pengaturan akun dan alamat pengiriman user.
    |
    */
    public function settings()
    {
        return view('users.settings.index');
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE SETTINGS (PROSES SIMPAN DATA PROFIL & ALAMAT)
    |--------------------------------------------------------------------------
    | Memperbarui data pribadi user (nama, hp, alamat lengkap) dan foto profil.
    | Data disimpan langsung ke tabel 'users' menggunakan mass assignment.
    |
    */
    public function updateSettings(Request $request)
    {
        // Validasi data input yang dikirim dari form blade settings
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'nullable|string|max:20',
            'provinsi' => 'nullable|string|max:100',
            'kota'     => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'alamat'   => 'nullable|string',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Batas maksimal 2MB
        ]);

        $user = auth()->user();

        // Ambil nama file avatar yang saat ini tersimpan di database (default)
        $avatar = $user->avatar;

        // Cek jika user mengunggah file foto profil baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama dari lokal storage jika ada, dan pastikan foto lama tersebut
            // bukan merupakan tautan eksternal (bukan link gambar profil dari Google Login)
            if ($user->avatar && !str_starts_with($user->avatar, 'http')) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Simpan file foto baru ke folder 'profile' di dalam disk public (storage/app/public/profile)
            $avatar = $request->file('foto')->store('profile', 'public');
        }

        // Jalankan perintah update data ke model User (sudah aman karena fillable sudah didaftarkan)
        $user->update([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'provinsi' => $request->provinsi,
            'kota'     => $request->kota,
            'kode_pos' => $request->kode_pos,
            'alamat'   => $request->alamat,
            'avatar'   => $avatar,
        ]);

        // Kembalikan ke halaman sebelumnya dengan membawa session sukses
        return back()->with('success', 'Profile berhasil diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | SEARCH PRODUK
    |--------------------------------------------------------------------------
    | Fitur pencarian produk katalog toko bunga berdasarkan keyword tertentu.
    |
    */
    public function search(Request $request)
    {
        // 1. Ambil keyword dari form pencarian dan bersihkan spasi liar di awal/akhir
        $keyword = trim($request->input('search'));
        
        // Jika kolom search kosong, langsung alihkan ke halaman utama katalog produk user
        if (empty($keyword)) {
            return redirect()->route('user.produk.index');
        }

        // 2. Jalankan Query Pencarian Produk yang sinkron dengan struktur database terbarumu
        $produk = Produk::with(['kategori', 'varian'])
                    ->where('status', 'public') // Memastikan produk yang dicari berstatus 'public'
                    ->where(function($q) use ($keyword) {
                        // Mencari kecocokan berdasarkan nama produk (menggunakan LOWER agar case-insensitive)
                        $q->where(DB::raw('LOWER(nama)'), 'LIKE', '%' . strtolower($keyword) . '%')
                        // Atau mencari kecocokan berdasarkan isi deskripsi produk
                          ->orWhere(DB::raw('LOWER(deskripsi)'), 'LIKE', '%' . strtolower($keyword) . '%');
                    })
                    ->latest()
                    ->paginate(12); // Membagi hasil pencarian menjadi 12 produk per halaman

        // Kirim hasil pencarian dan keyword asal ke view hasil pencarian
        return view('users.partials.search-results', compact('produk', 'keyword'));
    }
}