<?php

namespace Database\Seeders;

use App\Models\DonationRecap;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonationRecapsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 27; $i++) {
            $faker = Factory::create('id_ID');

            DonationRecap::create([
                'foreign_id' => $i + 1,
                'fullname' => $faker->name(),
                'type' => $faker->randomElement(['user_donations', 'product_donation_orders']),
                'amount' => $faker->randomElement([50000, 100000, 150000, 10000000, 27000, 56500, 730000]),
                'message' => $faker->sentence()
            ]);
        }
    }
}
