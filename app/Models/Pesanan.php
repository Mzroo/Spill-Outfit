<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    /**
     * Field yang diizinkan untuk diisi secara massal.
     * Kita hapus kolom alamat penerima karena sekarang diambil dari relasi user.
     */
    protected $fillable = [
        'user_id',
        'kode_pesanan',
        'catatan',
        'destination_id',
        'courier',
        'subtotal',
        'ongkir',
        'total_harga',
        'metode_pembayaran',
        'midtrans_order_id',
        'snap_token',
        'transaction_id',
        'status',
    ];

    /**
     * Casting tipe data agar Laravel menangani angka dengan benar.
     * Penting untuk menjaga presisi uang pada cetak struk/invoice.
     */
    protected $casts = [
        'subtotal'    => 'decimal:2',
        'ongkir'      => 'decimal:2',
        'total_harga' => 'decimal:2',
        'status'      => 'string',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI DATABASE
    |--------------------------------------------------------------------------
    */

    /**
     * Relasi ke User.
     * Sekarang kamu bisa mengakses alamat user dengan $pesanan->user->alamat
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke PesananItem.
     * Mengambil daftar produk yang dibeli.
     */
    public function items()
    {
        return $this->hasMany(PesananItem::class, 'pesanan_id');
    }
}