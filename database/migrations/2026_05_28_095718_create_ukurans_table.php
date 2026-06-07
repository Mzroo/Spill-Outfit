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

            // Nama ukuran (Small, Medium, Large)
            $table->string('nama');

            // Kode ukuran (S, M, L, XL)
            $table->string('kode')->unique();

            // Keterangan ukuran (Lingkar dada 90-95 cm)
            $table->string('keterangan')
                ->nullable();
            
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