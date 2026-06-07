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
        Schema::create('community_post', function (Blueprint $table) {
            $table->id();

            // USER PEMILIK POST
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // CONTENT
            $table->string('judul')->nullable();
            $table->text('caption')->nullable();
            $table->string('gambar')->nullable();

            // STATS & LIKE SYSTEM (Perubahan di Sini)
            $table->unsignedInteger('total_like')->default(0);
            $table->unsignedInteger('total_comment')->default(0);
            
            // Kolom JSON untuk menyimpan array ID user yang nge-like [1, 2, 5, dst]
            // Ini menggantikan fungsi tabel community_like!
            $table->json('liked_by_users')->nullable();

            // STATUS
            $table->enum('status', ['published', 'hidden'])->default('published');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_post');
    }
};