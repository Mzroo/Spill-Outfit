<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatMessage;

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
        | CARI ROOM ATAU BUAT BARU
        |--------------------------------------------------------------------------
        */
        $room = ChatRoom::firstOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'status' => 'open'
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | AMBIL CHAT
        |--------------------------------------------------------------------------
        */
        $messages = ChatMessage::where(
            'chat_room_id',
            $room->id
        )
        ->latest()
        ->get()
        ->reverse();

        /*
        |--------------------------------------------------------------------------
        | TANDAI SUDAH DIBACA
        |--------------------------------------------------------------------------
        */
        ChatMessage::where(
            'chat_room_id',
            $room->id
        )
        ->where('sender_type', 'admin')
        ->where('is_read', false)
        ->update([
            'is_read' => true
        ]);

        return view(
            'users.chat.index',
            compact(
                'room',
                'messages'
            )
        );
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
        | ROOM
        |--------------------------------------------------------------------------
        */
        $room = ChatRoom::firstOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'status' => 'open'
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | SIMPAN PESAN
        |--------------------------------------------------------------------------
        */
        ChatMessage::create([

            'chat_room_id' => $room->id,

            'sender_type' => 'user',
            'sender_id'   => $user->id,

            'message' => $request->message,

            'is_read' => false
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPDATE LAST MESSAGE
        |--------------------------------------------------------------------------
        */
        $room->update([
            'last_message_at' => now()
        ]);

        return back();
    }
}