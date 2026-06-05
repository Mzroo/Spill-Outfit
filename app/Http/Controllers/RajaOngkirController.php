<?php

namespace App\Http\Controllers;

use App\Services\RajaOngkirService;
use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
    protected RajaOngkirService $rajaOngkirService;

    // Inject Service ke dalam Controller
    public function __construct(RajaOngkirService $rajaOngkirService)
    {
        $this->rajaOngkirService = $rajaOngkirService;
    }

    /**
     * Mengambil data destinasi untuk dropdown checkout
     */
    public function getDestination(Request $request)
    {
        $search = $request->query('search', '');

        // Langsung return service-nya karena service sudah mengembalikan JsonResponse
        return $this->rajaOngkirService->searchDestination($search);
    }

    /**
     * Menghitung ongkos kirim berdasarkan pilihan user
     */
    public function calculateCost(Request $request)
    {
        // Validasi input dari frontend sebelum dilempar ke service
        $request->validate([
            'destination' => 'required',
            'weight'      => 'required|numeric',
            'courier'     => 'required|string',
        ]);

        $destination = $request->input('destination');
        $weight      = (int) $request->input('weight');
        $courier     = $request->input('courier');

        // Langsung return service-nya
        return $this->rajaOngkirService->calculateCost($destination, $weight, $courier);
    }
}