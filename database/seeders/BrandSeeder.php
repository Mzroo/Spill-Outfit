<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Brand::truncate(); // Kosongkan tabel sebelum mengisi data baru
        Schema::enableForeignKeyConstraints();

        $brands = [
            [
                'nama' => 'Erigo',
                'deskripsi' => 'Brand fashion lokal Indonesia yang berfokus pada pakaian kasual, streetwear, jaket, dan apparel kasual modern.',
            ],
            [
                'nama' => 'Roughneck 1991',
                'deskripsi' => 'Brand apparel yang sangat populer di kalangan anak muda dengan spesialisasi produk hoodie, sweatshirt, dan t-shirt bergaya grafis urban.',
            ],
            [
                'nama' => 'Uniqlo',
                'deskripsi' => 'Produsen busana kasual terkemuka asal Jepang yang terkenal dengan konsep LifeWear yang minimalis, nyaman, dan berkualitas tinggi.',
            ],
            [
                'nama' => 'HNM',
                'deskripsi' => 'Salah satu retail fashion global terbesar yang menyediakan tren pakaian modern terkini untuk gaya formal maupun harian.',
            ],
        ];

        foreach ($brands as $b) {
            Brand::create([
                'nama'      => $b['nama'],
                'slug'      => Str::slug($b['nama']),
                'logo'      => null, // Default kosong, diunggah via dashboard admin nanti
                'deskripsi' => $b['deskripsi'],
                'status'    => 'aktif',
            ]);
        }
    }
}