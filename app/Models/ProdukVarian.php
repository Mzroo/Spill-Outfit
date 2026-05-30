<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukVarian extends Model
{
    use HasFactory;

    protected $table = 'produk_varian';

    protected $fillable = [
        'produk_id',
        'ukuran_id',
        'warna_id',
        'stok',
        'harga',
    ];

    // =========================
    // RELASI KE PRODUK
    // =========================
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    // =========================
    // RELASI KE UKURAN
    // =========================
    public function ukuran()
    {
        return $this->belongsTo(Ukuran::class);
    }

    // =========================
    // RELASI KE WARNA
    // =========================
    public function warna()
    {
        return $this->belongsTo(Warna::class);
    }
}