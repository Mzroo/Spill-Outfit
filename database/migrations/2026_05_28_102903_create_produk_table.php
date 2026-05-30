<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {

            $table->id();

            // =========================
            // DATA PRODUK
            // =========================
            $table->string('kode')->unique();
            $table->string('nama');

            // =========================
            // RELASI
            // =========================
            $table->foreignId('kategori_id')
                ->constrained('kategori')
                ->cascadeOnDelete();

            $table->foreignId('brand_id')
                ->nullable()
                ->constrained('brand') // pastikan tabel brands
                ->nullOnDelete();

            // =========================
            // DETAIL PRODUK
            // =========================
            $table->bigInteger('harga');

            $table->text('deskripsi')->nullable();

            $table->string('gambar')->nullable();

            // =========================
            // STATUS
            // =========================
            $table->enum('status', [
                'public',
                'block'
            ])->default('public');

            $table->boolean('is_featured')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};