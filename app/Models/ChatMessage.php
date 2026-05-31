<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatMessage extends Model
{
    use HasFactory;

    protected $table = 'chat_message';

    protected $fillable = [

        'chat_room_id',

        'sender_type',
        'sender_id',

        'message',

        'is_read'
    ];

    /*
    |--------------------------------------------------------------------------
    | CAST
    |--------------------------------------------------------------------------
    */
    protected $casts = [

        'is_read' => 'boolean'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI KE ROOM
    |--------------------------------------------------------------------------
    */
    public function room()
    {
        return $this->belongsTo(
            ChatRoom::class,
            'chat_room_id'
        );
    }
}