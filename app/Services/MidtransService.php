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
        Config::$serverKey    = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized  = config('services.midtrans.is_sanitized');
        Config::$is3ds        = config('services.midtrans.is_3ds');
    }

    public function createSnapToken($pesanan, $items, $ongkirValue, $user)
    {
        try {
            $itemDetails = [];
            
            // Mengambil snapshot item pesanan
            foreach ($items as $item) {
                $itemDetails[] = [
                    'id'       => 'ITEM-' . $item->id,
                    'price'    => (int) $item->harga,
                    'quantity' => (int) $item->qty,
                    'name'     => substr($item->nama_produk, 0, 50),
                ];
            }

            // Ongkos Kirim
            if ($ongkirValue > 0) {
                $itemDetails[] = [
                    'id'       => 'ONGKIR',
                    'price'    => (int) $ongkirValue,
                    'quantity' => 1,
                    'name'     => 'Biaya Pengiriman',
                ];
            }

            // Payload transaksi mengambil data customer langsung dari data Profile ($user)
            $payload = [
                'transaction_details' => [
                    'order_id'     => $pesanan->kode_pesanan,
                    'gross_amount' => (int) $pesanan->total_harga, 
                ],
                'item_details' => $itemDetails,
                'customer_details' => [
                    'first_name' => $user->name,
                    'email'      => $user->email,
                    'phone'      => $user->phone ?? '0000000000', // Mencegah crash jika profile phone kosong
                    'shipping_address' => [
                        'first_name' => $user->name,
                        'phone'      => $user->phone ?? '0000000000',
                        'address'    => $user->alamat ?? 'Alamat Belum Diatur',
                        'city'       => $user->kota ?? '',
                    ]
                ],
                'expiry' => [
                    'start_time' => date("Y-m-d H:i:s O"),
                    'unit'       => 'day',
                    'duration'   => 1
                ]
            ];

            return Snap::getSnapToken($payload);

        } catch (Exception $e) {
            Log::error('Midtrans Create Snap Token Error: ' . $e->getMessage());
            return null;
        }
    }
}