<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;

class AdminChatController extends Controller
{
        // =========================================================================
    // CONSTRUCTOR MIDDLEWARE (Satpam Pengaman Sisi Backend)
    // =========================================================================
    public function __construct()
    {
        // Memaksa SELURUH fungsi/method di dalam controller ini wajib lolos 
        // satpam login ('auth') DAN wajib memiliki role admin ('admin')
        $this->middleware(['auth', 'admin']);
    }

    /*
    |--------------------------------------------------------------------------
    | LIST CHAT USER
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        // 1. Ambil ID chat terakhir dari masing-masing user
        $latestChatIds = Chat::selectRaw('MAX(id) as id')
            ->groupBy('user_id');

        // 2. Tarik data chat utuh, cukup eager load 'user' karena foto sudah di tabel users
        $chatGrouped = Chat::whereIn('id', $latestChatIds)
            ->latest()
            ->with(['user']) // UPDATE: Menghapus .profile karena data sudah menyatu di user
            ->get();

        return view('admin.chat.index', compact('chatGrouped'));
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL CHAT (RUANG OBROLAN SPESIFIK USER)
    |--------------------------------------------------------------------------
    */
    public function show($user_id)
    {
        // UPDATE: Langsung findOrFail user tanpa with('profile')
        $chatUser = User::findOrFail($user_id);

        /*
        |--------------------------------------------------------------------------
        | TANDAI SUDAH DIBACA BY ADMIN
        |--------------------------------------------------------------------------
        */
        Chat::where('user_id', $user_id)
            ->where('sender_type', 'user')
            ->where('is_read', false)
            ->update([
                'is_read' => true
            ]);

        // Ambil riwayat percakapan dari lama ke baru
        $messages = Chat::where('user_id', $user_id)
            ->oldest()
            ->get();

        return view('admin.chat.show', compact('messages', 'chatUser'));
    }

    /*
    |--------------------------------------------------------------------------
    | BALAS CHAT CUSTOMER
    |--------------------------------------------------------------------------
    */
    public function send(Request $request, $user_id)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        User::findOrFail($user_id);

        Chat::create([
            'user_id'     => $user_id,
            'sender_id'   => auth()->id(),
            'sender_type' => 'admin',
            'message'     => $request->message,
            'is_read'     => false
        ]);

        return back()->with('with_scroll', true);
    }
}