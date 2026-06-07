<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PesananItem extends Model
{
    use HasFactory;

    // Paksa nama tabel ke bentuk tunggal sesuai nama di file migration-mu
    protected $table = 'pesanan_item';

    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'produk_varian_id',
        'nama_produk',
        'nama_varian',
        'harga',
        'qty',
        'subtotal',
        'gambar',
    ];

    protected $casts = [
        'harga'    => 'integer',
        'qty'      => 'integer',
        'subtotal' => 'integer',
    ];

    /**
     * Relasi Balik ke Tabel Induk Pesanan
     */
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    /**
     * Relasi ke Tabel Produk Master (Katalog)
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}