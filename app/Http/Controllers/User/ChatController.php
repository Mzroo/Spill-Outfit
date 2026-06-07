<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat; // Menggunakan satu model utama saja

class ChatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN CHAT USER
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | AMBIL HISTORI CHAT BERDASARKAN USER_ID
        |--------------------------------------------------------------------------
        | Kita mengambil semua pesan yang melibatkan user ini, lalu diurutkan
        | dari yang paling lama ke terbaru untuk tampilan chatbox.
        */
        $messages = Chat::where('user_id', $user->id)
            ->oldest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TANDAI SUDAH DIBACA
        |--------------------------------------------------------------------------
        | Semua pesan di dalam ruang chat user ini yang dikirim oleh 'admin'
        | dan belum dibaca, otomatis di-update menjadi true.
        */
        Chat::where('user_id', $user->id)
            ->where('sender_type', 'admin')
            ->where('is_read', false)
            ->update([
                'is_read' => true
            ]);

        return view('users.chat.index', compact('messages'));
    }

    /*
    |--------------------------------------------------------------------------
    | KIRIM PESAN USER
    |--------------------------------------------------------------------------
    */
    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | SIMPAN PESAN KE SATU TABEL UTAMA
        |--------------------------------------------------------------------------
        | user_id     : Menandakan "Aparatur/Ruang Obrolan" milik siapa.
        | sender_id   : ID spesifik siapa yang mengetik (sama dengan user->id).
        | sender_type : Penanda peran agar tahu ini ketikan 'user' atau 'admin'.
        */
        Chat::create([
            'user_id'     => $user->id,
            'sender_id'   => $user->id,
            'sender_type' => 'user',
            'message'     => $request->message,
            'is_read'     => false
        ]);

        return back();
    }
}