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
        Schema::create('pesanan_item', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELASI PESANAN
            |--------------------------------------------------------------------------
            */
            $table->foreignId('pesanan_id')
                ->constrained('pesanan')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | RELASI PRODUK
            |--------------------------------------------------------------------------
            */
            $table->foreignId('produk_id')
                ->constrained('produk')
                ->cascadeOnDelete();

            $table->foreignId('produk_varian_id')
                ->nullable()
                ->constrained('produk_varian')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | SNAPSHOT PRODUK
            |--------------------------------------------------------------------------
            */
            $table->string('nama_produk');

            $table->string('nama_varian')
                ->nullable();

            $table->decimal('harga', 15, 2);

            $table->unsignedInteger('qty')
                ->default(1);

            $table->decimal('subtotal', 15, 2)
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | SNAPSHOT GAMBAR
            |--------------------------------------------------------------------------
            */
            $table->string('gambar')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_item');
    }
};