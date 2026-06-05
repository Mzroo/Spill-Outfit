<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommunityPost;
use App\Models\CommunityLike;
use App\Models\CommunityComment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // Ditambahkan untuk proteksi database transaction

class CommunityController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN COMMUNITY INDEX
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        // 1. Ambil data dari database
        $posts = CommunityPost::with([
            'user.profile',
        ])
        ->where('status', 'published')
        ->latest()
        ->get();

        // 2. Kirim variabel $posts ke file view blade Anda
        return view('users.community.index', compact('posts')); 
        // Pastikan 'users.community.index' sesuai dengan folder letak blade index Anda
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
        $post = CommunityPost::with([
            'user.profile',
            'comments' => function($query) {
                $query->where('status', 'show')->latest(); // Memastikan komentar diurutkan dari yang terbaru
            },
            'comments.user.profile'
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
            // Gambar diubah menjadi 'required' agar layout grid komunitas tetap estetik dan penuh visual
            'gambar'  => 'required|image|mimes:jpg,jpeg,png,webp|max:3072' 
        ]);

        $gambar = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('community', 'public');
        }

        CommunityPost::create([
            'user_id' => auth()->id(),
            'judul'   => $request->judul,
            'caption' => $request->caption,
            'gambar'  => $gambar,
            'status'  => 'published'
        ]);

        return redirect()
            ->route('community.index')
            ->with('success', 'Inspirasi outfit kamu berhasil dibagikan ✨');
    }

    /*
    |--------------------------------------------------------------------------
    | LIKE / UNLIKE (Database Transaction Protected)
    |--------------------------------------------------------------------------
    */
    public function like($id)
    {
        $post = CommunityPost::findOrFail($id);
        $userId = auth()->id();

        // Menggunakan Database Transaction mencegah angka total_like tidak akurat saat diakses banyak user sekaligus
        DB::transaction(function () use ($post, $userId) {
            $like = CommunityLike::where('community_post_id', $post->id)
                ->where('user_id', $userId)
                ->first();

            if ($like) {
                // UNLIKE ACTION
                $like->delete();
                if ($post->total_like > 0) {
                    $post->decrement('total_like');
                }
            } else {
                // LIKE ACTION
                CommunityLike::create([
                    'community_post_id' => $post->id,
                    'user_id'           => $userId
                ]);
                $post->increment('total_like');
            }
        });

        return back();
    }

    /*
    |--------------------------------------------------------------------------
    | KOMENTAR (Database Transaction Protected)
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

        // Hapus file fisik gambar dari storage lokal/cloud
        if ($post->gambar && Storage::disk('public')->exists($post->gambar)) {
            Storage::disk('public')->delete($post->gambar);
        }

        $post->delete();

        return back()->with('success', 'Postingan Anda berhasil dihapus');
    }
}