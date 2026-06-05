<?php

namespace Database\Seeders;

use App\Models\Warna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarnaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $daftarWarna = [
            [
                'nama' => 'Onyx Black',
                'kode_warna' => '#1A1A1A',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Creamy White',
                'kode_warna' => '#Fdfaf4',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Sage Green',
                'kode_warna' => '#728169',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Mocha Brown',
                'kode_warna' => '#705335',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Charcoal Grey',
                'kode_warna' => '#3A3F44',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Dusty Pink',
                'kode_warna' => '#DCAEAF',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Navy Blue',
                'kode_warna' => '#1B2A4A',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Terracotta',
                'kode_warna' => '#C36241',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Khaki Tan',
                'kode_warna' => '#CBB89D',
                'status' => 'nonaktif', // Contoh warna musim lalu yang sedang nonaktif
            ],
            [
                'nama' => 'Lilac Purple',
                'kode_warna' => '#D1C4E9',
                'status' => 'nonaktif',
            ],
        ];

        foreach ($daftarWarna as $warna) {
            Warna::create($warna);
        }
    }
}