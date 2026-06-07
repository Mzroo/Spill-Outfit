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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Kode User (US001, US002, dst)
            $table->string('user_code')->unique()->nullable();

            // Data User & Utama
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable(); // Bertindak sebagai nomor HP checkout

            // DATA PROFIL & ALAMAT PENGIRIMAN (Tambahan Baru di Sini)
            // Di-set nullable agar tidak error saat user baru mendaftar pertama kali
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kode_pos')->nullable();
            $table->text('alamat')->nullable(); 

            // Login Manual
            $table->string('password')->nullable();

            // Login Google & Foto Profil
            $table->string('google_id')->nullable()->unique();
            $table->string('avatar')->nullable(); // Menampung foto profil lokal / link Google

            // Role
            $table->enum('role', ['admin', 'user'])->default('user');

            // Status Akun
            $table->boolean('is_active')->default(true);

            // Verifikasi Email
            $table->timestamp('email_verified_at')->nullable();

            // Remember Me
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};