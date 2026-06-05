<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CommunityPost;
use Illuminate\Http\Request;
// Tambahkan import model Post Anda di sini

class HomeController extends Controller
{
    public function index(){
        return view('guest.index');
    }

    public function about(){
        return view('guest.about');
    }

    public function produk(){
        return view('guest.produk.index');
    }

    public function community()
    {
        // Ambil 6 postingan terbaru untuk preview guest beserta relasi user dan profilnya
        $posts = CommunityPost::with(['user.profile'])
                    ->latest()
                    ->take(6)
                    ->get();

        // Kirim data $posts ke view guest.community
        return view('guest.community', compact('posts'));
    }
}