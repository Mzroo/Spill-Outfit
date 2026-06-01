<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommunityPost extends Model
{
    use HasFactory;

    protected $table = 'community_post';

    protected $fillable = [

        'user_id',
        'judul',
        'caption',
        'gambar',
        'total_like',
        'total_comment',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI USER
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI LIKE
    |--------------------------------------------------------------------------
    */
    public function likes()
    {
        return $this->hasMany(
            CommunityLike::class,
            'community_post_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI COMMENT
    |--------------------------------------------------------------------------
    */
    public function comments()
    {
        return $this->hasMany(
            CommunityComment::class,
            'community_post_id'
        );
    }
}