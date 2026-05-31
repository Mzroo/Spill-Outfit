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
        Schema::create('chat_message', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELASI CHAT ROOM
            |--------------------------------------------------------------------------
            */
            $table->foreignId('chat_room_id')
                ->constrained('chat_room')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | PENGIRIM PESAN
            |--------------------------------------------------------------------------
            */
            $table->enum('sender_type', [
                'user',
                'admin'
            ]);

            /*
            |--------------------------------------------------------------------------
            | ID PENGIRIM
            |--------------------------------------------------------------------------
            */
            $table->unsignedBigInteger('sender_id');

            /*
            |--------------------------------------------------------------------------
            | PESAN
            |--------------------------------------------------------------------------
            */
            $table->text('message');

            /*
            |--------------------------------------------------------------------------
            | STATUS DIBACA
            |--------------------------------------------------------------------------
            */
            $table->boolean('is_read')
                ->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_message');
    }
};