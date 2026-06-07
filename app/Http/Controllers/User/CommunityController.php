<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommunityPost;
use App\Models\CommunityComment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CommunityController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN COMMUNITY INDEX
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        // Hubungan ke .profile dihapus karena data user & avatar langsung di tabel users
        $posts = CommunityPost::with([
            'user',
        ])
        ->where('status', 'published')
        ->latest()
        ->get();

        return view('users.community.index', compact('posts')); 
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN CREATE POST
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('users.community.create');
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL POST
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        // Membersihkan eager loading .profile pada user maupun komentar
        $post = CommunityPost::with([
            'user',
            'comments' => function($query) {
                $query->where('status', 'show')->latest();
            },
            'comments.user'
        ])
        ->where('status', 'published')
        ->findOrFail($id);

        return view('users.community.show', compact('post'));
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN POST
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'judul'   => 'nullable|string|max:255',
            'caption' => 'required|string|max:2000',
            'gambar'  => 'required|image|mimes:jpg,jpeg,png,webp|max:3072' 
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('community', 'public');
        }

        CommunityPost::create([
            'user_id'          => auth()->id(),
            'judul'            => $request->judul,
            'caption'          => $request->caption,
            'gambar'           => $gambar,
            'liked_by_users'   => [], // Set default berupa array kosong saat pertama buat post
            'status'           => 'published'
        ]);

        return redirect()
            ->route('community.index')
            ->with('success', 'Inspirasi outfit kamu berhasil dibagikan ✨');
    }

    /*
    |--------------------------------------------------------------------------
    | LIKE / UNLIKE (Sistem Array JSON Baru)
    |--------------------------------------------------------------------------
    */
    public function like($id)
    {
        $post = CommunityPost::findOrFail($id);
        $userId = auth()->id();

        // Ambil data array user yang sudah nge-like, jika kosong set jadi array kosong []
        $likedUsers = $post->liked_by_users ?? [];

        // Cek apakah ID user saat ini sudah ada di dalam array tersebut
        if (in_array($userId, $likedUsers)) {
            
            // ACTION: UNLIKE (Buang ID user dari array)
            $likedUsers = array_diff($likedUsers, [$userId]);
            
            // Atur ulang index array agar berurutan kembali setelah dihapus
            $likedUsers = array_values($likedUsers);

            // Update data post (Decrement total_like & simpan array baru)
            $post->update([
                'liked_by_users' => $likedUsers,
                'total_like'     => max(0, $post->total_like - 1) // Memastikan tidak minus
            ]);

        } else {
            
            // ACTION: LIKE (Tambahkan ID user ke dalam array)
            $likedUsers[] = $userId;

            // Update data post (Increment total_like & simpan array baru)
            $post->update([
                'liked_by_users' => $likedUsers,
                'total_like'     => $post->total_like + 1
            ]);
        }

        return back();
    }

    /*
    |--------------------------------------------------------------------------
    | KOMENTAR
    |--------------------------------------------------------------------------
    */
    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000'
        ]);

        $post = CommunityPost::findOrFail($id);

        DB::transaction(function () use ($request, $post) {
            CommunityComment::create([
                'community_post_id' => $post->id,
                'user_id'           => auth()->id(),
                'comment'           => $request->comment,
                'status'            => 'show'
            ]);

            $post->increment('total_comment');
        });

        return back()->with('success', 'Komentar berhasil ditambahkan ke diskusi');
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS POST
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $post = CommunityPost::findOrFail($id);

        // Validasi Kepemilikan (Owner)
        if ($post->user_id != auth()->id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk menghapus postingan ini.');
        }

        // Hapus file fisik gambar dari storage lokal
        if ($post->gambar && Storage::disk('public')->exists($post->gambar)) {
            Storage::disk('public')->delete($post->gambar);
        }

        $post->delete();

        return back()->with('success', 'Postingan Anda berhasil dihapus');
    }
}