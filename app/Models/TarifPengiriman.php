<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifPengiriman extends Model
{
    use HasFactory;

    // Deklarasikan nama tabel asli bahasa Indonesianya di database
    protected $table = 'tarif_pengiriman';

    protected $fillable = [
        'provinsi',
        'kota',
        'base_cost'
    ];
}