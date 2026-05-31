<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatMessage;

class AdminChatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LIST CHAT USER
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $rooms = ChatRoom::with([
            'user',
            'latestMessage'
        ])
        ->latest('last_message_at')
        ->get();

        return view(
            'admin.chat.index',
            compact('rooms')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL CHAT
    |--------------------------------------------------------------------------
    */
    public function show($id)
    {
        $room = ChatRoom::with([
            'user',
            'messages'
        ])->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | TANDAI SUDAH DIBACA
        |--------------------------------------------------------------------------
        */
        ChatMessage::where(
            'chat_room_id',
            $room->id
        )
        ->where('sender_type', 'user')
        ->where('is_read', false)
        ->update([
            'is_read' => true
        ]);

        $messages = ChatMessage::where(
            'chat_room_id',
            $room->id
        )
        ->oldest()
        ->get();

        return view(
            'admin.chat.show',
            compact(
                'room',
                'messages'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | BALAS CHAT
    |--------------------------------------------------------------------------
    */
    public function send(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $room = ChatRoom::findOrFail($id);

        ChatMessage::create([

            'chat_room_id' => $room->id,

            'sender_type' => 'admin',

            /*
            |--------------------------------------------------------------------------
            | GANTI DENGAN AUTH ADMIN
            |--------------------------------------------------------------------------
            */
            'sender_id' => auth()->id(),

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

        return back()->with(
            'success',
            'Pesan berhasil dikirim'
        );
    }
}