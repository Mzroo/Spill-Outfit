<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommunityComment extends Model
{
    use HasFactory;

    protected $table = 'community_comment';

    protected $fillable = [

        'community_post_id',
        'user_id',
        'comment',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI POST
    |--------------------------------------------------------------------------
    */
    public function post()
    {
        return $this->belongsTo(
            CommunityPost::class,
            'community_post_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI USER
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}