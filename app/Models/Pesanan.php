<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [

        'user_id',
        'kode_pesanan',

        'nama_penerima',
        'no_hp',
        'provinsi',
        'kota',
        'alamat',
        'kode_pos',
        'catatan',

        'subtotal',
        'ongkir',
        'total_harga',

        'metode_pembayaran',
        'status'
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
    | RELASI ITEM PESANAN
    |--------------------------------------------------------------------------
    */
    public function items()
    {
        return $this->hasMany(
            PesananItem::class,
            'pesanan_id'
        );
    }
}