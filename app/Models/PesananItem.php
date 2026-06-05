<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesananItem extends Model
{
    use HasFactory;

    protected $table = 'pesanan_item';

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | RELASI
        |--------------------------------------------------------------------------
        */
        'pesanan_id',

        'produk_id',

        'produk_varian_id',

        /*
        |--------------------------------------------------------------------------
        | SNAPSHOT PRODUK
        |--------------------------------------------------------------------------
        */
        'nama_produk',

        'nama_varian',

        'gambar',

        'harga',

        'qty',

        'subtotal',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI PESANAN
    |--------------------------------------------------------------------------
    */
    public function pesanan()
    {
        return $this->belongsTo(
            Pesanan::class,
            'pesanan_id'
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