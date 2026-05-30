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
        Schema::create('brand', function (Blueprint $table) {

            $table->id();

            // Nama Brand
            $table->string('nama');

            // URL Friendly
            $table->string('slug')->unique();

            // Logo Brand
            $table->string('logo')->nullable();

            // Deskripsi Brand
            $table->text('deskripsi')->nullable();

            // Status Brand
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
        Schema::dropIfExists('brand');
    }
};