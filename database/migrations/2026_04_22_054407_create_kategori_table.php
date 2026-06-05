<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id(); // ID internal database (Primary Key asli tetap aman & cepat untuk indexing)
            
            // Kolom kode unik untuk konsumsi publik/admin
            $table->string('kode_kategori')->unique(); 

            $table->string('nama');
            $table->string('slug')->unique();
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};