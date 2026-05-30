<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk_varian', function (Blueprint $table) {

            $table->id();

            // RELASI KE PRODUK
            $table->foreignId('produk_id')
                ->constrained('produk')
                ->cascadeOnDelete();

            // RELASI UKURAN
            $table->foreignId('ukuran_id')
                ->constrained('ukuran')
                ->cascadeOnDelete();

            // RELASI WARNA
            $table->foreignId('warna_id')
                ->constrained('warna')
                ->cascadeOnDelete();

            // STOK VARIAN
            $table->integer('stok')->default(0);

            // HARGA (opsional kalau beda varian)
            $table->bigInteger('harga')->nullable();

            $table->timestamps();

            // supaya tidak ada duplikat varian
            $table->unique(['produk_id', 'ukuran_id', 'warna_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk_varian');
    }
};