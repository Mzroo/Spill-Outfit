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
        'liked_by_users', // TAMBAHKAN INI: Agar field JSON bisa di-isi lewat Eloquent/Controller
        'status'
    ];

    // TAMBAHKAN INI: Otomatis konversi string JSON dari DB menjadi Array PHP murni
    protected $casts = [
        'liked_by_users' => 'array',
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
    | RELASI LIKE (Sistem JSON Array)
    |--------------------------------------------------------------------------
    | Karena kita menyimpan ID user yang menyukai postingan langsung di dalam 
    | kolom 'liked_by_users' (tipe data JSON) pada tabel 'community_post', 
    | kita tidak memerlukan relasi Eloquent terpisah (seperti belongsToMany) 
    | untuk fitur Like ini. Cukup dikelola langsung via array/casts di atas.
    */

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