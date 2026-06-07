<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ukuran extends Model
{
    use HasFactory;

    protected $table = 'ukuran';

    protected $fillable = [
        'nama',
        'kode',
        'keterangan',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    // Ukuran dipakai di banyak varian produk
    public function produkVarian()
    {
        return $this->hasMany(ProdukVarian::class, 'ukuran_id');
    }
}