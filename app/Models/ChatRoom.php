<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatRoom extends Model
{
    use HasFactory;

    protected $table = 'chat_room';

    protected $fillable = [

        'user_id',
        'status',
        'last_message_at'
    ];

    /*
    |--------------------------------------------------------------------------
    | CAST
    |--------------------------------------------------------------------------
    */
    protected $casts = [

        'last_message_at' => 'datetime'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI KE USER
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI KE CHAT MESSAGE
    |--------------------------------------------------------------------------
    */
    public function messages()
    {
        return $this->hasMany(
            ChatMessage::class,
            'chat_room_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | LAST MESSAGE
    |--------------------------------------------------------------------------
    */
    public function latestMessage()
    {
        return $this->hasOne(
            ChatMessage::class,
            'chat_room_id'
        )->latestOfMany();
    }
}