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
        Schema::create('community_comment', function (Blueprint $table) {
            $table->id();

            // RELASI POST
            $table->foreignId('community_post_id')
                ->constrained('community_post')
                ->cascadeOnDelete();

            // USER YANG MEMBERIKAN KOMENTAR
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // ISI KOMENTAR
            $table->text('comment');

            // STATUS KOMENTAR
            $table->enum('status', ['show', 'hidden'])->default('show');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_comment');
    }
};