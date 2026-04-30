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
    'harga',
    'stok',
    'status',
    'deskripsi',
    'gambar'
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
