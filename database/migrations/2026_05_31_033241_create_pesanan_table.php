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
        Schema::create('pesanan', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | USER
            |--------------------------------------------------------------------------
            */
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | KODE PESANAN
            |--------------------------------------------------------------------------
            */
            $table->string('kode_pesanan')
                ->unique();

            /*
            |--------------------------------------------------------------------------
            | DATA PENERIMA
            |--------------------------------------------------------------------------
            */
            $table->string('nama_penerima');

            $table->string('no_hp');

            $table->string('provinsi')
                ->nullable();

            $table->string('kota')
                ->nullable();

            $table->text('alamat');

            $table->string('kode_pos')
                ->nullable();

            $table->text('catatan')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | RAJA ONGKIR
            |--------------------------------------------------------------------------
            */
            $table->string('destination_id')
                ->nullable();

            $table->string('courier')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | TOTAL BELANJA
            |--------------------------------------------------------------------------
            */
            $table->decimal('subtotal', 15, 2)
                ->default(0);

            $table->decimal('ongkir', 15, 2)
                ->default(0);

            $table->decimal('total_harga', 15, 2)
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | PEMBAYARAN
            |--------------------------------------------------------------------------
            */
            $table->string('metode_pembayaran')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | MIDTRANS
            |--------------------------------------------------------------------------
            */
            $table->string('midtrans_order_id')
                ->nullable();

            $table->text('snap_token')
                ->nullable();

            $table->string('transaction_id')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */
            $table->enum('status', [

                'unpaid',

                'paid',

                'diproses',

                'dikirim',

                'selesai',

                'dibatalkan'

            ])->default('unpaid');

            $table->timestamps();
        });
    }

    /**
     * Reverse migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};