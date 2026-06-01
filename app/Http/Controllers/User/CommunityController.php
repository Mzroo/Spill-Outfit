<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommunityPost;
use App\Models\CommunityLike;
use App\Models\CommunityComment;
use Illuminate\Support\Facades\Storage;

class CommunityController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN COMMUNITY
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $posts = CommunityPost::with([
            'user.profile',
            'likes',
            'comments.user.profile'
        ])
        ->where('status', 'published')
        ->latest()
        ->get();

        return view(
            'users.community.index',
            compact('posts')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN CREATE POST
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view(
            'users.community.create'
        );
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
            'comments.user.profile',
            'likes'
        ])
        ->where('status', 'published')
        ->findOrFail($id);

        return view(
            'users.community.show',
            compact('post')
        );
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
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $gambar = null;

        /*
        |--------------------------------------------------------------------------
        | UPLOAD GAMBAR
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('gambar')) {

            $gambar = $request
                ->file('gambar')
                ->store(
                    'community',
                    'public'
                );
        }

        CommunityPost::create([

            'user_id' => auth()->id(),

            'judul' => $request->judul,

            'caption' => $request->caption,

            'gambar' => $gambar,

            'status' => 'published'
        ]);

        return redirect()
            ->route('community.index')
            ->with(
                'success',
                'Postingan berhasil dibuat'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | LIKE / UNLIKE
    |--------------------------------------------------------------------------
    */
    public function like($id)
    {
        $post = CommunityPost::findOrFail($id);

        $like = CommunityLike::where(
            'community_post_id',
            $post->id
        )
        ->where(
            'user_id',
            auth()->id()
        )
        ->first();

        /*
        |--------------------------------------------------------------------------
        | UNLIKE
        |--------------------------------------------------------------------------
        */
        if ($like) {

            $like->delete();

            if ($post->total_like > 0) {

                $post->decrement(
                    'total_like'
                );
            }

        }

        /*
        |--------------------------------------------------------------------------
        | LIKE
        |--------------------------------------------------------------------------
        */
        else {

            CommunityLike::create([

                'community_post_id'
                    => $post->id,

                'user_id'
                    => auth()->id()
            ]);

            $post->increment(
                'total_like'
            );
        }

        return back();
    }

    /*
    |--------------------------------------------------------------------------
    | KOMENTAR
    |--------------------------------------------------------------------------
    */
    public function comment(
        Request $request,
        $id
    )
    {
        $request->validate([
            'comment'
                => 'required|string|max:1000'
        ]);

        $post = CommunityPost::findOrFail($id);

        CommunityComment::create([

            'community_post_id'
                => $post->id,

            'user_id'
                => auth()->id(),

            'comment'
                => $request->comment,

            'status'
                => 'show'
        ]);

        $post->increment(
            'total_comment'
        );

        return back()->with(
            'success',
            'Komentar berhasil ditambahkan'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS POST
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $post = CommunityPost::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | VALIDASI OWNER
        |--------------------------------------------------------------------------
        */
        if (
            $post->user_id
            != auth()->id()
        ) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | HAPUS GAMBAR
        |--------------------------------------------------------------------------
        */
        if (
            $post->gambar &&
            Storage::disk('public')
                ->exists($post->gambar)
        ) {

            Storage::disk('public')
                ->delete($post->gambar);
        }

        $post->delete();

        return back()->with(
            'success',
            'Postingan berhasil dihapus'
        );
    }
}