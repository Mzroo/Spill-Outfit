<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | RELASI PESANAN
            |--------------------------------------------------------------------------
            */
            $table->foreignId('pesanan_id')
                ->constrained('pesanan')
                ->cascadeOnDelete()
                ->index();

            /*
            |--------------------------------------------------------------------------
            | INFORMASI PEMBAYARAN
            |--------------------------------------------------------------------------
            */
            $table->string('kode_pembayaran')
                ->unique()
                ->nullable();

            $table->enum('provider', [
                'manual',
                'midtrans'
            ])->default('midtrans');

            /*
            |--------------------------------------------------------------------------
            | METODE PEMBAYARAN
            |--------------------------------------------------------------------------
            */
            $table->string('metode_pembayaran')->nullable();
            // contoh: bank_transfer, qris, gopay, shopeepay

            /*
            |--------------------------------------------------------------------------
            | MIDTRANS DATA
            |--------------------------------------------------------------------------
            */
            $table->string('transaction_id')->nullable();
            $table->string('snap_token')->nullable();
            $table->string('payment_type')->nullable();

            /*
            |--------------------------------------------------------------------------
            | TOTAL BAYAR
            |--------------------------------------------------------------------------
            */
            $table->decimal('total_bayar', 15, 2);

            /*
            |--------------------------------------------------------------------------
            | BUKTI PEMBAYARAN
            |--------------------------------------------------------------------------
            */
            $table->string('bukti_pembayaran')->nullable();

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */
            $table->enum('status', [
                'pending',
                'menunggu_verifikasi',
                'dibayar',
                'gagal',
                'expired',
                'refund'
            ])->default('pending');

            /*
            |--------------------------------------------------------------------------
            | WAKTU BAYAR
            |--------------------------------------------------------------------------
            */
            $table->timestamp('dibayar_pada')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};