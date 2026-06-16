<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'kode_kategori',
        'nama',
        'slug',
        'gambar',
        'deskripsi',
        'status',
    ];

    /**
     * Logika otomatisasi pembuatan kode kustom unik tanpa tahun
     */
    protected static function booted()
    {
        static::creating(function ($kategori) {
            
            // 1. Hapus whereYear agar mengecek seluruh data terbaru tanpa batas tahun
            $dataTerakhir = static::latest('id')->first();
            
            $nomorUrut = 1;
            
            if ($dataTerakhir && $dataTerakhir->kode_kategori) {
                // Mengambil 4 digit angka terakhir dari kode
                $nomorTerakhir = (int) substr($dataTerakhir->kode_kategori, -4);
                $nomorUrut = $nomorTerakhir + 1;
            }

            // 2. Ubah format pembuatan string di sini (Menghilangkan bagian tahun)
            // Hasilnya akan menjadi: KSO-0001, KSO-0002, dst.
            $kategori->kode_kategori = 'KSO' . '-' . str_pad($nomorUrut, 4, '0', STR_PAD_LEFT);
        });
    }

    /**
     * RELASI ONE-TO-MANY
     */
    public function produk()
    {
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}