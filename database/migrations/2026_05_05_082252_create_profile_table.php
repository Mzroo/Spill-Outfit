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
        Schema::create('profile', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELASI USER
            |--------------------------------------------------------------------------
            */
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | DATA PENERIMA
            |--------------------------------------------------------------------------
            */
            $table->string('nama_penerima')
                ->nullable();

            $table->string('no_hp')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | DATA RAJA ONGKIR
            |--------------------------------------------------------------------------
            */
            $table->string('provinsi_id')
                ->nullable();

            $table->string('kota_id')
                ->nullable();

            $table->string('provinsi')
                ->nullable();

            $table->string('kota')
                ->nullable();

            $table->string('kecamatan')
                ->nullable();

            $table->string('kode_pos')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | ALAMAT LENGKAP
            |--------------------------------------------------------------------------
            */
            $table->text('alamat')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | FOTO PROFILE
            |--------------------------------------------------------------------------
            */
            $table->string('foto')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};