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
        Schema::create('community_like', function (Blueprint $table) {

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
            | USER YANG LIKE
            |--------------------------------------------------------------------------
            */
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | 1 USER = 1 LIKE
            |--------------------------------------------------------------------------
            */
            $table->unique([
                'community_post_id',
                'user_id'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_like');
    }
};