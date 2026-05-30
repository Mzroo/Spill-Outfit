<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori', function (Blueprint $table) {

            $table->id();

            // Nama kategori
            $table->string('nama');

            // URL slug
            $table->string('slug')->unique();

            // Gambar kategori
            $table->string('gambar')->nullable();

            // Deskripsi kategori
            $table->text('deskripsi')->nullable();

            // Status kategori
            $table->enum('status', [
                'aktif',
                'nonaktif'
            ])->default('aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};