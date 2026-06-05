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
    | PROFILE
    |--------------------------------------------------------------------------
    */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /*
    |--------------------------------------------------------------------------
    | CHAT ROOM
    |--------------------------------------------------------------------------
    */
    public function chatRoom()
    {
        return $this->hasOne(
            ChatRoom::class,
            'user_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | COMMUNITY POST
    |--------------------------------------------------------------------------
    */
    public function communityPosts()
    {
        return $this->hasMany(
            CommunityPost::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | COMMUNITY LIKE
    |--------------------------------------------------------------------------
    */
    public function communityLikes()
    {
        return $this->hasMany(
            CommunityLike::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | COMMUNITY COMMENT
    |--------------------------------------------------------------------------
    */
    public function communityComments()
    {
        return $this->hasMany(
            CommunityComment::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ROLE
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