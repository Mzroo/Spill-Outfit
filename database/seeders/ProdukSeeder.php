<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Brand;
use App\Models\ProdukVarian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        // =========================================================================
        // AUTOMATIC TRUNCATE (SATEPTY RESET BIAR PASTI MULAI DARI PSO-0001)
        // =========================================================================
        // Menonaktifkan foreign key check sebentar biar bisa mengosongkan tabel relasi
        Schema::disableForeignKeyConstraints();
        ProdukVarian::truncate(); // Kosongkan tabel varian
        Produk::truncate();       // Kosongkan tabel produk utama
        Schema::enableForeignKeyConstraints();

        // 1. Ambil semua kategori dan brand dari database
        $kategoris = Kategori::all();
        $brands = Brand::all();

        // 2. Ambil ID dari tabel ukuran dan warna untuk merelasikan varian
        $ukuranIds = DB::table('ukuran')->pluck('id')->toArray();
        $warnaIds = DB::table('warna')->pluck('id')->toArray();

        // Pengaman jika seeder master (Kategori, Ukuran, Warna) belum dijalankan
        if ($kategoris->isEmpty() || empty($ukuranIds) || empty($warnaIds)) {
            $this->command->error('MOHON CEK: Pastikan seeder Kategori, Ukuran, dan Warna sudah dijalankan terlebih dahulu sebelum ProdukSeeder!');
            return;
        }

        // 3. Blueprint 20 data produk premium bertema Spill Outfit
        $dataProduk = [
            [
                'nama' => 'Campus Hoodie Oversize Premium',
                'deskripsi' => 'Hoodie oversized berbahan katun fleece tebal yang sangat nyaman untuk dipakai seharian di area kampus. Desain kasual, modern, dan sangat mudah dipadukan dengan celana jeans.',
                'harga' => 149000,
            ],
            [
                'nama' => 'Varsity Jacket Vintage Crewneck',
                'deskripsi' => 'Jaket varsity bertema klasik retro dengan bordir detail premium. Cocok banget untuk streetwear fashion, kumpul bareng teman, maupun outfit hangout malam minggu.',
                'harga' => 210000,
            ],
            [
                'nama' => 'Formal Office Slim-Fit Shirt',
                'deskripsi' => 'Kemeja formal dengan potongan slim-fit yang memberikan kesan rapi, tegas, dan profesional. Menggunakan bahan premium katun Oxford yang adem dan tidak mudah kusut.',
                'harga' => 175000,
            ],
            [
                'nama' => 'Daily Campus Basic Sweatshirt',
                'deskripsi' => 'Sweater polos esensial dengan potongan rileks yang pas untuk gaya santai mahasiswa. Pilihan warna estetik, minimalis, dan tetap hangat dipakai di ruangan ber-AC.',
                'harga' => 129000,
            ],
            [
                'nama' => 'Korean Style Pleated Skirt Outfit',
                'deskripsi' => 'Rok lipit ala fashion Korea modern yang anggun dan stylish. Sangat serasi dikombinasikan dengan blazer kasual maupun kaos basic untuk tampilan hangout feminin.',
                'harga' => 135000,
            ],
            [
                'nama' => 'Retro Corduroy Jacket Casual',
                'deskripsi' => 'Jaket berbahan korduroi bertekstur premium untuk melengkapi gaya layering kamu. Memberikan nuansa vintage yang aesthetic, tangguh, namun tetap lembut di kulit.',
                'harga' => 199000,
            ],
            [
                'nama' => 'Streetwear Cargo Pants Loose',
                'deskripsi' => 'Celana cargo dengan banyak kantong fungsional yang modis. Bahan twill stretch yang fleksibel, sangat cocok mendukung aktivitas harian yang padat dan dinamis.',
                'harga' => 185000,
            ],
            [
                'nama' => 'Smart Casual Linen Blazer',
                'deskripsi' => 'Blazer semi-formal berbahan linen ringan berkualitas tinggi. Pilihan terbaik untuk tampil profesional saat presentasi tugas kuliah maupun menghadiri acara formal santai.',
                'harga' => 245000,
            ],
            [
                'nama' => 'Aesthetic Knit Outer Cardigan',
                'deskripsi' => 'Kardigan rajut bertekstur lembut dengan gaya loose-fit yang trendi. Memberikan kesan cozy look yang sangat manis dipandang untuk mix and match daily outfit.',
                'harga' => 159000,
            ],
            [
                'nama' => 'Urban Denim Jacket Signature',
                'deskripsi' => 'Jaket jeans denim timeless dengan efek washing yang kece. Bahan kokoh, jahitan super rapi, dan tidak pernah salah untuk dipakai dalam gaya fashion generasi Z.',
                'harga' => 220000,
            ],
            [
                'nama' => 'Minimalist Earth-Tone Vest Knit',
                'deskripsi' => 'Rompi rajut minimalis dengan potongan leher V bernuansa earth-tone hangat. Sangat ciamik dipadukan di luar kemeja putih polos untuk look prep atau ala anak senja estetik.',
                'harga' => 115000,
            ],
            [
                'nama' => 'Old Money Tailored Chino Pants',
                'deskripsi' => 'Celana chinos dengan potongan presisi tinggi yang memberikan impresi mewah dan berkelas (Old Money Look). Bahan katun twill combed premium lembut berdaya tahan tinggi.',
                'harga' => 195000,
            ],
            [
                'nama' => 'Sporty Tracksuit Active Jacket',
                'deskripsi' => 'Jaket training kasual bergaya sporty yang sangat aerodinamis namun stylish. Bahan parasut taslan windbreaker, cocok untuk jogging pagi ataupun sekadar berkendara motor.',
                'harga' => 165000,
            ],
            [
                'nama' => 'Oversized Graphic Streetwear Tee',
                'deskripsi' => 'Kaos oversized dengan sablon grafis pop-culture bernuansa hypebeast modern. Bahan katun combed 24s super tebal, anti-gerah, dan sangat jatuh pas di badan.',
                'harga' => 99000,
            ],
            [
                'nama' => 'Vintage Flannel Premium Shirt',
                'deskripsi' => 'Kemeja flanel bermotif kotak klasik dengan perpaduan warna yang maskulin dan berkarakter. Bisa dijadikan kemeja utama maupun sebagai outer kaos oblong santai.',
                'harga' => 155000,
            ],
            [
                'nama' => 'Korean Oversized Trench Coat',
                'deskripsi' => 'Coat panjang kasual berdesain modern ala drakor populer. Menawarkan struktur siluet tubuh yang elegan, sangat pas dipakai saat menghadiri event fashion malam atau musim hujan.',
                'harga' => 299000,
            ],
            [
                'nama' => 'Casual Premium Polo Knitwear',
                'deskripsi' => 'Kaos polo bertekstur rajut halus tanpa kancing yang minimalis dan fleksibel. Memberikan kesan santai namun tetap terlihat sopan dan berwibawa di lingkungan profesional.',
                'harga' => 145000,
            ],
            [
                'nama' => 'Monochrome High-Waist Trousers',
                'deskripsi' => 'Celana kulot wanita berpotongan high-waist yang jenjang dan estetik. Pilihan warna monokrom bersih, sangat ideal untuk dipadupadankan dengan crop top ataupun kemeja.',
                'harga' => 139000,
            ],
            [
                'nama' => 'Harajuku Techwear Functional Windbreaker',
                'deskripsi' => 'Jaket techwear futuristik tahan air (waterproof) dilengkapi banyak saku utility modern. Sangat ikonik untuk penggemar aliran gaya fashion jalanan urban yang eksentrik.',
                'harga' => 275000,
            ],
            [
                'nama' => 'Daily Home Relaxed Pyjamas Set',
                'deskripsi' => 'Setelan pakaian santai (one-set) berbahan katun rayon super adem dan lembut. Pilihan fungsional terbaik untuk kenyamanan aktivitas di rumah maupun sekadar pergi ke warung terdekat.',
                'harga' => 120000,
            ],
        ];

        // 4. Looping data produk untuk disisipkan ke database
        foreach ($dataProduk as $index => $item) {
            $kategoriAcak = $kategoris->random();
            $brandAcak = $brands->isNotEmpty() ? $brands->random()->id : null;

            // Membuat nomor urut serial PSO (Pasti 100% Mulai dari 0001 karena tabel di atas selalu di-reset)
            $nomorUrut = str_pad($index + 1, 4, '0', STR_PAD_LEFT);
            $kodeOtomatis = 'PSO-' . $nomorUrut;

            $produk = Produk::create([
                'kode'        => $kodeOtomatis,
                'nama'        => $item['nama'],
                'kategori_id' => $kategoriAcak->id,
                'brand_id'    => $brandAcak,
                'harga'       => $item['harga'],
                'deskripsi'   => $item['deskripsi'],
                'gambar'      => null,
                'status'      => 'public',
                'is_featured' => ($index < 8) ? true : false,
            ]);

            // Ambil maksimal 3 ID ukuran dan 2 ID warna yang ada di DB agar tidak melesat kosong
            $ukuranTerpilih = array_slice($ukuranIds, 0, min(3, count($ukuranIds)));
            $warnaTerpilih  = array_slice($warnaIds, 0, min(2, count($warnaIds)));

            foreach ($ukuranTerpilih as $uId) {
                foreach ($warnaTerpilih as $wId) {
                    ProdukVarian::create([
                        'produk_id' => $produk->id,
                        'ukuran_id' => $uId,
                        'warna_id'  => $wId,
                        'stok'      => rand(10, 40),
                        'harga'     => null,
                    ]);
                }
            }
        }

        $this->command->info('Berhasil menyegarkan tabel dan menyuntikkan 20 data produk serial PSO-0001 s.d PSO-0020!');
    }
}