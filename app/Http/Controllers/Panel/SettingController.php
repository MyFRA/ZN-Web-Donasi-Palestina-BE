<?php

namespace App\Http\Controllers\Panel;

use App\Helpers\ModelFileUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\Setting\UpdateRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::first();
        $provinces = Http::withHeader('key', config('app.RAJAONGKIR_API_KEY'))
            ->get('https://api.rajaongkir.com/starter/province')->object()->rajaongkir->results;
        $cities = Http::withHeader('key', config('app.RAJAONGKIR_API_KEY'))
            ->get('https://api.rajaongkir.com/starter/city?province=' . $setting->shipping_province_id)->object()->rajaongkir->results;

        return view('panel.pages.setting.edit', [
            'setting' => $setting,
            'provinces' => $provinces,
            'cities' => $cities,
        ]);
    }

    public function update(UpdateRequest $request)
    {
        $setting = Setting::first();
        $shipping_province = '';
        $shipping_city = '';

        $provinces = Http::withHeader('key', config('app.RAJAONGKIR_API_KEY'))
            ->get('https://api.rajaongkir.com/starter/province')->object()->rajaongkir->results;
        $cities = Http::withHeader('key', config('app.RAJAONGKIR_API_KEY'))
            ->get('https://api.rajaongkir.com/starter/city?province=' . $setting->shipping_province_id)->object()->rajaongkir->results;

        foreach ($provinces as $province) {
            if ($province->province_id == $request->shipping_province_id) {
                $shipping_province = $province->province;
            }
        }

        foreach ($cities as $city) {
            if ($city->city_id == $request->shipping_city_id) {
                $shipping_city = $city->type . ' ' . $city->city_name;
            }
        }

        $setting->update([
            'company_name' => $request->company_name,
            'company_logo' => ModelFileUploadHelper::modelFileUpdate($setting, 'company_logo', $request->file('company_logo')),
            'company_description' => $request->company_description,
            'shipping_province' => $shipping_province,
            'shipping_province_id' => $request->shipping_province_id,
            'shipping_city' => $shipping_city,
            'shipping_city_id' => $request->shipping_city_id,
            'additional_shipping_fee' => $request->additional_shipping_fee,
        ]);

        return back()->with('success', 'Pengaturan Perusahaan telah diupdate');
    }
}
