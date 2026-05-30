<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Produk;
use App\Models\ProdukVarian;

class Keranjang extends Model
{
    protected $table = 'keranjang';

    protected $fillable = [
        'user_id',
        'produk_id',
        'produk_varian_id',
        'qty'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI USER
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
    | RELASI PRODUK
    |--------------------------------------------------------------------------
    */
    public function produk()
    {
        return $this->belongsTo(
            Produk::class,
            'produk_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI VARIAN
    |--------------------------------------------------------------------------
    */
    public function varian()
    {
        return $this->belongsTo(
            ProdukVarian::class,
            'produk_varian_id'
        );
    }
}