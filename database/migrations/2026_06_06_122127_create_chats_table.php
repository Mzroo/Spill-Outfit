<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            // Menandakan obrolan ini milik user siapa (Akan dikelompokkan berdasarkan kolom ini di sisi Admin)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Pengirim pesan murni (bisa ID user itu sendiri, bisa ID admin)
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            
            // Pembeda peran pengirim
            $table->enum('sender_type', ['user', 'admin']);
            
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};