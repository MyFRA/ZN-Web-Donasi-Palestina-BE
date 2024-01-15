<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    private $products = [
        [
            'image' => 'http://kalasahan.matursoft.com/storage/products/image/image-OWQD-325335.jpg',
            'name' => 'Kaos Palestina',
            'price' => 150000
        ],
        [
            'image' => 'https://ae01.alicdn.com/kf/Sc7d1081954b54c02bd1ddb917f03ffe4U/Gelas-kopi-Palestina-cangkir-cangkir-kopi-lucu-dan-cangkir-berbeda.jpg',
            'name' => 'Mug Palestina',
            'price' => 50000
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->products as $product) {
            Product::create($product);
        }
    }
}
