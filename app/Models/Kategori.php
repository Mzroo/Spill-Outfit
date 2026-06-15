<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    // Daftarkan 'kode_kategori' agar diizinkan dalam Mass Assignment
    protected $fillable = [
        'kode_kategori',
        'nama',
        'slug',
        'gambar',
        'deskripsi',
        'status',
    ];

    /**
     * Logika otomatisasi pembuatan kode kustom unik
     */
    protected static function booted()
    {
        static::creating(function ($kategori) {
            $tahunSaatIni = date('Y'); // Mengambil tahun saat ini
            
            // Cari data kategori terakhir yang dibuat pada tahun ini
            $dataTerakhir = static::whereYear('created_at', $tahunSaatIni)
                                  ->latest('id')
                                  ->first();
            
            $nomorUrut = 1;
            
            if ($dataTerakhir && $dataTerakhir->kode_kategori) {
                // Mengambil 4 digit angka terakhir dari kode
                $nomorTerakhir = (int) substr($dataTerakhir->kode_kategori, -4);
                $nomorUrut = $nomorTerakhir + 1;
            }

            // Gabungkan menjadi string berformat: KTG-2026-0001
            $kategori->kode_kategori = 'KSO' . $tahunSaatIni . '-' . str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);
        });
    }

    /**
     * ========================================================
     * RELASI ONE-TO-MANY (Satu Kategori punya banyak Produk)
     * ========================================================
     * Hubungkan model Kategori ini ke model Produk Spill Outfit kamu.
     */
    public function produk()
    {
        // Parameter kedua ('kategori_id') adalah foreign key yang ada di tabel produk
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}