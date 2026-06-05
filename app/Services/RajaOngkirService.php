<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RajaOngkirService
{
    private string $apiKey;
    private string $baseUrl;
    private int    $origin;

    public function __construct()
    {
        $this->apiKey  = config('rajaongkir.api_key');
        $this->baseUrl = rtrim(config('rajaongkir.base_url'), '/');
        $this->origin  = (int) config('rajaongkir.origin');
    }

    /**
     * Fitur Pencarian Destinasi Kompatibel (Komerce & Official)
     */
    public function searchDestination(string $search): JsonResponse
    {
        try {
            // Deteksi jenis API berdasarkan URL di config/ .env
            $isKomerce = str_contains($this->baseUrl, 'komerce.id');

            if ($isKomerce) {
                // Jalur API Komerce
                $response = Http::withHeaders([
                    'key'           => $this->apiKey,
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Accept'        => 'application/json',
                ])
                ->timeout(10)
                ->get("{$this->baseUrl}/destination/domestic-destination", [
                    'search' => $search,
                    'limit'  => 10,
                ]);
            } else {
                // Jalur API RajaOngkir Official
                $response = Http::withHeaders(['key' => $this->apiKey])
                    ->timeout(10)
                    ->get("{$this->baseUrl}/city");
            }

            // Jika HTTP request gagal (Token salah, Server Down, RTO)
            if ($response->failed()) {
                Log::error('RajaOngkir/Komerce API Destination Error', [
                    'status' => $response->status(),
                    'body'   => $response->json() ?? $response->body(),
                    'url'    => $this->baseUrl
                ]);

                return response()->json([
                    'status'  => false,
                    'message' => 'Gagal terhubung ke penyedia kurir. Cek laravel.log (Status: ' . $response->status() . ')',
                ], 502);
            }

            $json = $response->json();
            $formattedData = [];

            if ($isKomerce) {
                // Parsing Data Komerce
                $rawDestinations = $json['data'] ?? [];
                foreach ($rawDestinations as $item) {
                    $label = $item['label'] ?? '';
                    if (empty($label)) {
                        $sub = $item['subdistrict_name'] ?? '';
                        $cit = $item['city_name'] ?? '';
                        $prov = $item['province_name'] ?? '';
                        $label = trim("Kec. {$sub}, {$cit} ({$prov})");
                    }
                    $formattedData[] = [
                        'id'    => $item['id'] ?? $item['subdistrict_id'] ?? $item['city_id'],
                        'label' => $label
                    ];
                }
            } else {
                // Parsing Data RajaOngkir Official dengan Filter Local
                $results = $json['rajaongkir']['results'] ?? [];
                foreach ($results as $item) {
                    $label = "{$item['type']} {$item['city_name']} ({$item['province']})";
                    if (stripos($label, $search) !== false) {
                        $formattedData[] = [
                            'id'    => $item['city_id'],
                            'label' => $label
                        ];
                    }
                }
                $formattedData = array_slice($formattedData, 0, 10);
            }

            return response()->json([
                'status' => true,
                'data'   => $formattedData
            ]);

        } catch (\Exception $e) {
            Log::error('RajaOngkir/Komerce Exception', ['error' => $e->getMessage()]);
            return response()->json([
                'status'  => false,
                'message' => 'Terjadi kesalahan internal: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Fitur Hitung Ongkir Kompatibel (Komerce & Official)
     */
    public function calculateCost(string $destination, int $weight, string $courier): JsonResponse
    {
        try {
            $isKomerce = str_contains($this->baseUrl, 'komerce.id');

            if ($isKomerce) {
                // Jalur Hitung Ongkir Komerce
                $response = Http::withHeaders([
                    'key'           => $this->apiKey,
                    'Authorization' => 'Bearer ' . $this->apiKey,
                ])
                ->timeout(15)
                ->asForm()
                ->post("{$this->baseUrl}/calculate/domestic-cost", [
                    'origin'      => $this->origin,
                    'destination' => $destination,
                    'weight'      => $weight,
                    'courier'     => $courier,
                    'price'       => 'lowest',
                ]);
            } else {
                // Jalur Hitung Ongkir RajaOngkir Official
                $response = Http::withHeaders(['key' => $this->apiKey])
                    ->timeout(15)
                    ->asForm()
                    ->post("{$this->baseUrl}/cost", [
                        'origin'      => $this->origin,
                        'destination' => $destination,
                        'weight'      => $weight,
                        'courier'     => $courier,
                    ]);
            }

            if ($response->failed()) {
                Log::error('RajaOngkir/Komerce API Cost Error', [
                    'status' => $response->status(),
                    'body'   => $response->json() ?? $response->body()
                ]);

                return response()->json([
                    'status'  => false,
                    'message' => 'Gagal menghitung biaya ongkir (Status: ' . $response->status() . ').',
                ], 502);
            }

            $json = $response->json();
            
            // Satukan format output agar Javascript di Blade tetap membaca .costs dengan lancar
            $costs = $isKomerce 
                ? ($json['data']['costs'] ?? $json['data'] ?? [])
                : ($json['rajaongkir']['results'][0]['costs'] ?? []);

            return response()->json([
                'status' => true,
                'data'   => [
                    'costs' => $costs
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('RajaOngkir Cost Exception', ['error' => $e->getMessage()]);
            return response()->json([
                'status'  => false,
                'message' => 'Gagal memproses perhitungan ongkir.',
            ], 500);
        }
    }
}