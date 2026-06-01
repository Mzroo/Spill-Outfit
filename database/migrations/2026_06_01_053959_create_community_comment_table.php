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
        Schema::create('community_comment', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELASI POST
            |--------------------------------------------------------------------------
            */
            $table->foreignId('community_post_id')
                ->constrained('community_post')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | USER KOMENTAR
            |--------------------------------------------------------------------------
            */
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | KOMENTAR
            |--------------------------------------------------------------------------
            */
            $table->text('comment');

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */
            $table->enum('status', [
                'show',
                'hidden'
            ])->default('show');

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_comment');
    }
};