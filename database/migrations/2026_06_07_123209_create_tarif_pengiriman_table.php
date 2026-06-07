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
            
            // Nama Provinsi (Contoh: DKI Jakarta, Jawa Barat)
            $table->string('provinsi');
            
            // Nama Kota / Kabupaten (Contoh: Kota Bekasi, Kota Jakarta Selatan)
            $table->string('kota');
            
            // Tarif dasar ongkir ke wilayah tersebut.
            // Menggunakan decimal(15,2) agar presisi dan tipenya sama dengan kolom ongkir di tabel pesananmu.
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