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
            'shipping_province' => 'DKI Jakarta',
            'shipping_province_id' => 6,
            'shipping_city' => 'Jakarta Pusat',
            'shipping_city_id' => 152,
            'additional_shipping_fee' => 5000
        ]);
    }
}
