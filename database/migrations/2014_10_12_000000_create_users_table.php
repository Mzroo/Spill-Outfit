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

            // Data User
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();

            // Login Manual
            $table->string('password')->nullable();

            // Login Google
            $table->string('google_id')->nullable()->unique();
            $table->string('avatar')->nullable();

            // Role
            $table->enum('role', ['admin', 'user'])
                ->default('user');

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