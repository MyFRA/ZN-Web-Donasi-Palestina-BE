<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Shipping\GetCostsRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShippingController extends Controller
{
    public function getCourier()
    {
        return response()->json([
            'data' => [
                'jne', 'pos', 'tiki'
            ]
        ]);
    }

    public function getProvinces()
    {
        $response = Http::withHeader('key', config('app.RAJAONGKIR_API_KEY'))
            ->get('https://api.rajaongkir.com/starter/province');

        return response()->json([
            'data' => $response->object()->rajaongkir->results
        ]);
    }

    public function getCities(Request $request)
    {
        if (!$request->province_id) {
            return abort(404);
        }

        $response = Http::withHeader('key', config('app.RAJAONGKIR_API_KEY'))
            ->get('https://api.rajaongkir.com/starter/city?province=' . $request->province_id);

        return response()->json([
            'data' => $response->object()->rajaongkir->results
        ]);
    }

    public function getCosts(GetCostsRequest $request)
    {
        $setting = Setting::first();

        $response = Http::withHeader('key', config('app.RAJAONGKIR_API_KEY'))
            ->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $setting->shipping_city_id,
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => $request->courier,
            ]);

        return response()->json([
            'data' => $response->object()->rajaongkir->results[0]->costs
        ]);
    }
}
