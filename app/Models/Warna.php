<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warna extends Model
{
    use HasFactory;

    protected $table = 'warna';

    protected $fillable = [
        'nama',
        'kode_warna',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    // Warna dipakai di banyak varian produk
    public function produkVarian()
    {
        return $this->hasMany(ProdukVarian::class, 'warna_id');
    }
}