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
            | 1 user = 1 profile
            */
            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | DATA PROFILE CUSTOMER
            |--------------------------------------------------------------------------
            */
            $table->string('nama_penerima')
                ->nullable();

            $table->string('no_hp')
                ->nullable();

            $table->string('provinsi')
                ->nullable();

            $table->string('kota')
                ->nullable();

            $table->text('alamat')
                ->nullable();

            $table->string('kode_pos')
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