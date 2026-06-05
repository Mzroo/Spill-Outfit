<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ukuran;
use Illuminate\Support\Facades\Schema;

class UkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Ukuran::truncate();
        Schema::enableForeignKeyConstraints();

        $sizes = [
            [
                'nama' => 'Small',
                'kode' => 'S',
                'keterangan' => 'Lingkar Dada: 90-95 cm, Panjang: 65 cm',
                'urutan' => 1,
            ],
            [
                'nama' => 'Medium',
                'kode' => 'M',
                'keterangan' => 'Lingkar Dada: 96-100 cm, Panjang: 68 cm',
                'urutan' => 2,
            ],
            [
                'nama' => 'Large',
                'kode' => 'L',
                'keterangan' => 'Lingkar Dada: 101-105 cm, Panjang: 71 cm',
                'urutan' => 3,
            ],
            [
                'nama' => 'Extra Large',
                'kode' => 'XL',
                'keterangan' => 'Lingkar Dada: 106-110 cm, Panjang: 74 cm',
                'urutan' => 4,
            ],
            [
                'nama' => 'Double Extra Large',
                'kode' => 'XXL',
                'keterangan' => 'Lingkar Dada: 111-115 cm, Panjang: 76 cm',
                'urutan' => 5,
            ],
            [
                'nama' => 'All Size',
                'kode' => 'Fit to L',
                'keterangan' => 'Ukuran fleksibel menggunakan karet/bahan melar, muat hingga size L harian',
                'urutan' => 6,
            ],
        ];

        foreach ($sizes as $size) {
            Ukuran::create([
                'nama'       => $size['nama'],
                'kode'       => $size['kode'],
                'keterangan' => $size['keterangan'],
                'urutan'     => $size['urutan'],
                'status'     => 'aktif',
            ]);
        }
    }
}