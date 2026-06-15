<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Nonaktifkan foreign key check sementara agar proses pengosongan data aman
        Schema::disableForeignKeyConstraints();
        
        // 2. Kosongkan tabel kategori sebelum mengisi data baru (Mencegah Duplikasi)
        Kategori::truncate();
        
        // 3. Aktifkan kembali foreign key check
        Schema::enableForeignKeyConstraints();

        // 4. Data mentah 8 kategori khusus Fashion Spill Outfit (Premium Looks)
        $categories = [
            [
                'nama' => 'Campus Style',
                'deskripsi' => 'Inspirasi padu padan outfit kuliah yang rapi, sopan, namun tetap terlihat santai, kasual, dan stylish.',
            ],
            [
                'nama' => 'Casual Style',
                'deskripsi' => 'Gaya santai sehari-hari yang nyaman dipakai untuk nongkrong, jalan-jalan, atau sekadar bersantai bersama teman.',
            ],
            [
                'nama' => 'Streetwear',
                'deskripsi' => 'Kombinasi fashion jalanan modern yang ekspresif dengan sentuhan budaya pop, penggunaan hoodie, oversize shirt, dan sneakers.',
            ],
            [
                'nama' => 'Formal Wear',
                'deskripsi' => 'Rekomendasi pakaian rapi dan profesional untuk kebutuhan dunia kerja, magang, seminar, maupun acara resmi lainnya.',
            ],
            [
                'nama' => 'Daily Outfit',
                'deskripsi' => 'Inspirasi kombinasi pakaian sederhana, minimalis, dan fungsional yang cocok dipakai beraktivitas di rumah atau lingkungan sekitar.',
            ],
            [
                'nama' => 'Minimalist Aesthetic',
                'deskripsi' => 'Paduan pakaian dengan warna-warna netral atau earth-tone murni, potongan bersih, tanpa motif berlebihan untuk kesan berkelas.',
            ],
            [
                'nama' => 'Korean OOTD',
                'deskripsi' => 'Inspirasi tren fashion ala Korea Selatan (K-Style) yang imut, estetik, dan sangat populer di kalangan Gen-Z saat ini.',
            ],
            [
                'nama' => 'Sporty Casual',
                'deskripsi' => 'Kombinasi pakaian olahraga yang fleksibel seperti jersey, jagger pants, atau polo shirt yang tetap trendi dibawa jalan.',
            ],
        ];

        // 5. Lakukan perulangan untuk menyimpan data ke database
        foreach ($categories as $cat) {
            Kategori::create([
                'nama'      => $cat['nama'],
                'slug'      => Str::slug($cat['nama']), // Otomatis membuat URL aman (ex: minimalist-aesthetic)
                'gambar'    => null, // Default kosong, bisa diganti lewat menu upload admin
                'deskripsi' => $cat['deskripsi'],
                'status'    => 'aktif',
            ]);
        }
    }
}