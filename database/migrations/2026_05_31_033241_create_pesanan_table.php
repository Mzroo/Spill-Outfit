<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run migrations.
     */
    public function up(): void
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | USER RELATION (Kunci Utama Alamat & Data Penerima)
            |--------------------------------------------------------------------------
            | Karena alamat murni mengambil dari user, kita cukup mencatat ID user saja.
            | Nama, No HP, Alamat, Kota, Provinsi akan ditarik langsung dari tabel users.
            */
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | KODE PESANAN & CATATAN TAMBAHAN
            |--------------------------------------------------------------------------
            */
            $table->string('kode_pesanan')
                ->unique();

            // Catatan tetap diperlukan jika user ingin menulis pesan tambahan (misal: "titip tetangga")
            $table->text('catatan')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | TOTAL BELANJA
            |--------------------------------------------------------------------------
            */
            $table->decimal('subtotal', 15, 2)
                ->default(0);

            $table->decimal('ongkir', 15, 2)
                ->default(0);

            $table->decimal('total_harga', 15, 2)
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | PEMBAYARAN & MIDTRANS
            |--------------------------------------------------------------------------
            */
            $table->string('metode_pembayaran')
                ->nullable();

            $table->string('midtrans_order_id')
                ->nullable();

            $table->text('snap_token')
                ->nullable();

            $table->string('transaction_id')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */
            $table->enum('status', [
                'unpaid',      // Tetap unpaid tidak apa-apa karena bawaan dari sistem store() awal kamu
                'dibayar',     // DIUBAH: Dari 'paid' menjadi 'dibayar' agar singkron dengan Controller & Admin
                'diproses',
                'dikirim',
                'selesai',
                'dibatalkan'
            ])->default('unpaid');

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};