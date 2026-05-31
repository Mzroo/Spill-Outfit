<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [

        'pesanan_id',

        // internal payment code
        'kode_pembayaran',

        // manual / midtrans
        'provider',

        // metode pembayaran
        'metode_pembayaran',

        // midtrans data
        'transaction_id',
        'snap_token',
        'payment_type',

        // total
        'total_bayar',

        // bukti transfer manual
        'bukti_pembayaran',

        // status pembayaran
        'status',

        // waktu bayar
        'dibayar_pada'
    ];

    protected $casts = [
        'dibayar_pada' => 'datetime',
        'total_bayar'  => 'decimal:2'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}