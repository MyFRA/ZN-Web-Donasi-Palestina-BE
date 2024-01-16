<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'company_logo' => 'http://kalasahan.matursoft.com/logo.jpg',
            'company_name' => 'Kalasahan',
            'company_description' => 'Kalasahan adalah organisasi amal yang berkomitmen memberikan bantuan kepada anak-anak di Palestina untuk mendukung kesejahteraan dan pengembangan mereka.',
            'shipping_province' => 'DKI Jakarta',
            'shipping_province_id' => 6,
            'shipping_city' => 'Jakarta Pusat',
            'shipping_city_id' => 152,
            'additional_shipping_fee' => 5000
        ]);
    }
}
