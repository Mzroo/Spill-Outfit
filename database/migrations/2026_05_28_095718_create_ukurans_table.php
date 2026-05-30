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
        Schema::create('ukuran', function (Blueprint $table) {

            $table->id();

            // Nama ukuran
            $table->string('nama');
            // contoh: Small, Medium, Large

            // Kode ukuran
            $table->string('kode')->unique();
            // contoh: S, M, L, XL

            // Keterangan ukuran
            $table->string('keterangan')
                ->nullable();
            // contoh: Lingkar dada 90-95 cm

            // Urutan tampil
            $table->integer('urutan')
                ->default(0);

            // Status ukuran
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
        Schema::dropIfExists('ukuran');
    }
};