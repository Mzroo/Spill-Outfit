<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keranjang', function (Blueprint $table) {

            $table->id();

            // USER LOGIN
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // PRODUK
            $table->foreignId('produk_id')
                ->constrained('produk')
                ->cascadeOnDelete();

            // VARIAN PRODUK
            $table->foreignId('produk_varian_id')
                ->constrained('produk_varian')
                ->cascadeOnDelete();

            // JUMLAH
            $table->unsignedInteger('qty')
                ->default(1);

            $table->timestamps();

            // supaya produk + varian user tidak double
            $table->unique([
                'user_id',
                'produk_id',
                'produk_varian_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};