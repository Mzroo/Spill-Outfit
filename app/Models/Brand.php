<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brand';

    // 1. Daftarkan 'kode_brand' agar diizinkan dalam Mass Assignment (Kebutuhan Nomor 3)
    protected $fillable = [
        'kode_brand',
        'nama',
        'slug',
        'logo',
        'deskripsi',
        'status'
    ];

    /**
     * 2. Logika otomatisasi pembuatan kode kustom unik untuk Brand (BRD-YYYY-0001)
     */
    protected static function booted()
    {
        static::creating(function ($brand) {
            $tahunSaatIni = date('Y'); // Mengambil tahun berjalan (Contoh: 2026)
            
            // Cari data brand terakhir yang dibuat pada tahun ini
            $dataTerakhir = static::whereYear('created_at', $tahunSaatIni)
                                  ->latest('id')
                                  ->first();
            
            $nomorUrut = 1;
            
            if ($dataTerakhir && $dataTerakhir->kode_brand) {
                // Mengambil 4 digit angka terakhir dari kode (Misal BRD-2026-0002 diambil angka 2)
                $nomorTerakhir = (int) substr($dataTerakhir->kode_brand, -4);
                $nomorUrut = $nomorTerakhir + 1;
            }

            // Gabungkan menjadi string berformat: BRD-2026-0001
            // str_pad memastikan angka tetap berbentuk 4 digit (1 menjadi 0001, 12 menjadi 0012)
            $brand->kode_brand = 'BRD-' . $tahunSaatIni . '-' . str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION
    |--------------------------------------------------------------------------
    */

    /**
     * Relasi One-to-Many (Satu brand memiliki banyak produk)
     */
    public function produk()
    {
        return $this->hasMany(Produk::class, 'brand_id');
    }
}