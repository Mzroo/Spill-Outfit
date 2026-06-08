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
    Schema::create('tarif_pengiriman', function (Blueprint $table) {
        $table->id();
        
        $table->string('provinsi')->index(); // Tambahkan index
        $table->string('kota')->index();     // Tambahkan index
        $table->string('kode_pos')->nullable(); // Opsional
        $table->decimal('base_cost', 15, 2)->default(0); 

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarif_pengiriman');
    }
};