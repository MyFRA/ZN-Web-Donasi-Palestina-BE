<?php

namespace Database\Seeders;

use App\Models\AvailableDonation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvailableDonationSeeder extends Seeder
{
    private $arrData = [
        // [
        //     'title' => 'Rp 50rb',
        //     'value' => '50000',
        //     'short_description' => 'Paket Obat-Obatan',
        //     'description' => 'Paket donasi obat-obatan untuk Palestina dirancang dengan harapan memberikan bantuan kesehatan yang mendesak di tengah kondisi sulit. Setiap paket mencakup obat-esensial dan perawatan kesehatan dasar, bertujuan memberikan dukungan langsung kepada masyarakat yang memerlukan. Kontribusi Anda akan menjadi sinar harapan dalam upaya meningkatkan kesejahteraan kesehatan di Palestina.'
        // ],
        // [
        //     'title' => 'Rp 100rb',
        //     'value' => '100000',
        //     'short_description' => 'Paket Makanan + Obat-Obatan',
        //     'description' => 'Paket donasi obat-obatan dan pakaian kami dirancang untuk memberikan bantuan yang merangkul kebutuhan mendesak di Palestina. Dalam setiap paket, obat-esensial disertakan untuk mendukung upaya perawatan kesehatan dasar, sementara pakaian memberikan kehangatan dan perlindungan. Kolaborasi ini bertujuan untuk membawa bantuan langsung kepada masyarakat yang menghadapi situasi sulit. Dengan memberikan kontribusi, Anda tidak hanya memberikan bantuan fisik yang sangat dibutuhkan tetapi juga mengirimkan pesan solidaritas dan dukungan kepada mereka yang sedang berjuang di Palestina.'
        // ],
        [
            'title' => 'Nominal',
            'value' => 'lainnya',
            'short_description' => 'Lainnya',
            'description' => null
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->arrData as $key => $value) {
            AvailableDonation::create($value);
        }
    }
}
