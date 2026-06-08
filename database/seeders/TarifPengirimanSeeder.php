<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TarifPengiriman;

class TarifPengirimanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DISESUAIKAN: Menambahkan field 'kode_pos' untuk pencarian relasi lokasi & ongkir
        $dataTarif = [
            [
                'provinsi'  => 'DKI Jakarta',
                'kota'      => 'Kota Jakarta Selatan',
                'kode_pos'  => '12110',
                'base_cost' => 10000,
            ],
            [
                'provinsi'  => 'DKI Jakarta',
                'kota'      => 'Kota Jakarta Timur',
                'kode_pos'  => '13110',
                'base_cost' => 10000,
            ],
            [
                'provinsi'  => 'DKI Jakarta',
                'kota'      => 'Kota Jakarta Barat',
                'kode_pos'  => '11110',
                'base_cost' => 10000,
            ],
            [
                'provinsi'  => 'DKI Jakarta',
                'kota'      => 'Kota Jakarta Pusat',
                'kode_pos'  => '10110',
                'base_cost' => 10000,
            ],
            [
                'provinsi'  => 'DKI Jakarta',
                'kota'      => 'Kota Jakarta Utara',
                'kode_pos'  => '14110',
                'base_cost' => 10000,
            ],
            [
                'provinsi'  => 'Jawa Barat',
                'kota'      => 'Kota Bekasi',
                'kode_pos'  => '17111',
                'base_cost' => 12000,
            ],
            [
                'provinsi'  => 'Jawa Barat',
                'kota'      => 'Kabupaten Bekasi',
                'kode_pos'  => '17610', // Contoh Kode Pos area Muara Gembong / Babelan sekitarnya
                'base_cost' => 15000,
            ],
            [
                'provinsi'  => 'Jawa Barat',
                'kota'      => 'Kota Bogor',
                'kode_pos'  => '16111',
                'base_cost' => 15000,
            ],
            [
                'provinsi'  => 'Jawa Barat',
                'kota'      => 'Kota Depok',
                'kode_pos'  => '16411',
                'base_cost' => 12000,
            ],
            [
                'provinsi'  => 'Jawa Barat',
                'kota'      => 'Kota Bandung',
                'kode_pos'  => '40111',
                'base_cost' => 18000,
            ],
            [
                'provinsi'  => 'Banten',
                'kota'      => 'Kota Tangerang',
                'kode_pos'  => '15111',
                'base_cost' => 14000,
            ],
            [
                'provinsi'  => 'Jawa Tengah',
                'kota'      => 'Kota Semarang',
                'kode_pos'  => '50111',
                'base_cost' => 22000,
            ],
            [
                'provinsi'  => 'Jawa Timur',
                'kota'      => 'Kota Surabaya',
                'kode_pos'  => '60111',
                'base_cost' => 25000,
            ],
            [
                'provinsi'  => 'Bali',
                'kota'      => 'Kota Denpasar',
                'kode_pos'  => '80111',
                'base_cost' => 30000,
            ],
        ];

        // Looping untuk memasukkan data satu per satu ke database
        foreach ($dataTarif as $tarif) {
            TarifPengiriman::create($tarif);
        }
    }
}