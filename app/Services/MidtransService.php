<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Exception;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    public function __construct()
    {
        // Konfigurasi dasar Midtrans SDK
        Config::$serverKey    = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized  = config('services.midtrans.is_sanitized');
        Config::$is3ds        = config('services.midtrans.is_3ds');
    }

    /**
     * Membuat Snap Token untuk Pembayaran
     */
    public function createSnapToken($pesanan, $items, $ongkirValue, $user)
    {
        try {
            $itemDetails = [];
            
            // 1. Masukkan produk dari keranjang ke item details Midtrans
            foreach ($items as $item) {
                $harga = $item->varian->harga ?? $item->produk->harga;
                $itemDetails[] = [
                    'id'       => 'PROD-' . $item->produk_id,
                    'price'    => (int) $harga,
                    'quantity' => (int) $item->qty,
                    'name'     => substr($item->produk->nama, 0, 50), // Batasi nama maks 50 karakter
                ];
            }

            // 2. Masukkan Ongkos Kirim sebagai item terpisah
            if ($ongkirValue > 0) {
                $itemDetails[] = [
                    'id'       => 'ONGKIR',
                    'price'    => (int) $ongkirValue,
                    'quantity' => 1,
                    'name'     => 'Biaya Pengiriman (' . strtoupper($pesanan->kurir) . ')',
                ];
            }

            // 3. Rakit Transaksi Payload
            $payload = [
                'transaction_details' => [
                    'order_id'     => $pesanan->invoice_number, // Harus unik tiap transaksi
                    'gross_amount' => (int) $pesanan->total_pembayaran,
                ],
                'item_details' => $itemDetails,
                'customer_details' => [
                    'first_name' => $pesanan->nama_penerima,
                    'email'      => $user->email,
                    'phone'      => $pesanan->no_hp,
                    'shipping_address' => [
                        'first_name' => $pesanan->nama_penerima,
                        'phone'      => $pesanan->no_hp,
                        'address'    => $pesanan->alamat,
                    ]
                ],
                // Opsional: Batasi metode pembayaran jika diperlukan
                'expiry' => [
                    'start_time' => date("Y-m-d H:i:s O"),
                    'unit'       => 'day',
                    'duration'   => 1
                ]
            ];

            // Kirim ke Midtrans API untuk mendapatkan token
            return Snap::getSnapToken($payload);

        } catch (Exception $e) {
            Log::error('Midtrans Create Snap Token Error: ' . $e->getMessage());
            return null;
        }
    }
}