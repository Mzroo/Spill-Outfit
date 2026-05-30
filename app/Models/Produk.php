<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'kode',
        'nama',
        'kategori_id',
        'brand_id',
        'harga',
        'deskripsi',
        'gambar',
        'status',
        'is_featured',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    // =========================
    // KATEGORI
    // =========================
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // =========================
    // BRAND
    // =========================
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // =========================
    // VARIAN (PENGGANTI STOK LAMA)
    // =========================
    public function varian()
    {
        return $this->hasMany(ProdukVarian::class);
    }

    // =========================
    // TOTAL STOK DARI VARIAN
    // =========================
    public function getTotalStokAttribute()
    {
        return $this->varian->sum('stok');
    }

    // =========================
    // GAMBAR TAMBAHAN
    // =========================
    public function gambarTambahan()
    {
        return $this->hasMany(ProdukGambar::class);
    }

    // =========================
    // KERANJANG
    // =========================
    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }
}