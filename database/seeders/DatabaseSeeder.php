<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            AvailableDonationSeeder::class,
            SettingsTableSeeder::class,
            ProductsTableSeeder::class,
            DonationRecapsTableSeeder::class,
            NewsTableSeeder::class,
            SettingsTableSeeder::class,
            SettingWebDonationsTableSeeder::class,
            VirtualBanksTableSeeder::class
        ]);
    }
}
