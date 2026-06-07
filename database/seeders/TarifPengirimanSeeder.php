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
        // Data kota dan tarif dasar (base_cost) untuk testing checkout kamu
        $dataTarif = [
            [
                'provinsi'  => 'DKI Jakarta',
                'kota'      => 'Kota Jakarta Selatan',
                'base_cost' => 10000,
            ],
            [
                'provinsi'  => 'DKI Jakarta',
                'kota'      => 'Kota Jakarta Timur',
                'base_cost' => 10000,
            ],
            [
                'provinsi'  => 'DKI Jakarta',
                'kota'      => 'Kota Jakarta Barat',
                'base_cost' => 10000,
            ],
            [
                'provinsi'  => 'DKI Jakarta',
                'kota'      => 'Kota Jakarta Pusat',
                'base_cost' => 10000,
            ],
            [
                'provinsi'  => 'DKI Jakarta',
                'kota'      => 'Kota Jakarta Utara',
                'base_cost' => 10000,
            ],
            [
                'provinsi'  => 'Jawa Barat',
                'kota'      => 'Kota Bekasi',
                'base_cost' => 12000,
            ],
            [
                'provinsi'  => 'Jawa Barat',
                'kota'      => 'Kabupaten Bekasi',
                'base_cost' => 15000,
            ],
            [
                'provinsi'  => 'Jawa Barat',
                'kota'      => 'Kota Bogor',
                'base_cost' => 15000,
            ],
            [
                'provinsi'  => 'Jawa Barat',
                'kota'      => 'Kota Depok',
                'base_cost' => 12000,
            ],
            [
                'provinsi'  => 'Jawa Barat',
                'kota'      => 'Kota Bandung',
                'base_cost' => 18000,
            ],
            [
                'provinsi'  => 'Banten',
                'kota'      => 'Kota Tangerang',
                'base_cost' => 14000,
            ],
            [
                'provinsi'  => 'Jawa Tengah',
                'kota'      => 'Kota Semarang',
                'base_cost' => 22000,
            ],
            [
                'provinsi'  => 'Jawa Timur',
                'kota'      => 'Kota Surabaya',
                'base_cost' => 25000,
            ],
            [
                'provinsi'  => 'Bali',
                'kota'      => 'Kota Denpasar',
                'base_cost' => 30000,
            ],
        ];

        // Looping untuk memasukkan data satu per satu ke database
        foreach ($dataTarif as $tarif) {
            TarifPengiriman::create($tarif);
        }
    }
}