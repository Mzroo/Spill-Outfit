<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chats';

    protected $fillable = [
        'user_id',
        'sender_id',
        'sender_type', // 'user' atau 'admin'
        'message',
        'is_read'
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // Relasi ke User pemilik obrolan/room
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke User spesifik yang mengirimkan pesan
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}