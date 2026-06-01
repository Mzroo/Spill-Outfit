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
        Schema::create('community_post', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | USER PEMILIK POST
            |--------------------------------------------------------------------------
            */
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | CONTENT
            |--------------------------------------------------------------------------
            */
            $table->string('judul')
                ->nullable();

            $table->text('caption')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | FOTO POST
            |--------------------------------------------------------------------------
            */
            $table->string('gambar')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | STATS
            |--------------------------------------------------------------------------
            */
            $table->unsignedInteger('total_like')
                ->default(0);

            $table->unsignedInteger('total_comment')
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */
            $table->enum('status', [
                'published',
                'hidden'
            ])->default('published');

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_post');
    }
};