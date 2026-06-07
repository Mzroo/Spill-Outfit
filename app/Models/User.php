<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Mass Assignable
     */
    protected $fillable = [
        'user_code',
        'name',
        'email',
        'phone',
        
        // Kolom alamat baru:
        'provinsi',
        'kota',
        'kode_pos',
        'alamat',
        
        'password',
        'google_id',
        'avatar',
        'role',
        'is_active',
    ];

    /**
     * Hidden Attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute Casting
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];
    
    /*
    |--------------------------------------------------------------------------
    | LIVE CHAT RELATION
    |--------------------------------------------------------------------------
    | Hubungan One-to-Many antara User dan model Chat tunggal.
    | Seorang user bisa memiliki banyak baris pesan obrolan di dalam aplikasi.
    */
    public function chats()
    {
        return $this->hasMany(Chat::class, 'user_id');
    }


    /*
    |--------------------------------------------------------------------------
    | COMMUNITY POST
    |--------------------------------------------------------------------------
    */
    public function communityPosts()
    {
        return $this->hasMany(CommunityPost::class);
    }

    /*
    |--------------------------------------------------------------------------
    | COMMUNITY COMMENT
    |--------------------------------------------------------------------------
    */
    public function communityComments()
    {
        return $this->hasMany(CommunityComment::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ROLE CHECK
    |--------------------------------------------------------------------------
    */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }
}