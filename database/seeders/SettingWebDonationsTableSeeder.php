<?php

namespace Database\Seeders;

use App\Models\SettingWebDonation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingWebDonationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SettingWebDonation::create([
            'title' => 'Bantu Anak-anak Korban Genosida di Gaza, Palestina',
            'thumbnail' => 'https://donasipalestina.id/wp-content/uploads/2021/05/Banner-Bantu-Gaza-Kembali-Bangkit-11.jpg',
            'description' =>
            '<p><strong>Program donasi untuk membantu anak-anak yang menjadi korban konflik antara Israel dan Hamas di Gaza&nbsp;</strong><br><br>merupakan inisiatif yang sangat penting. Menurut laporan terbaru dari Kompas (6 November 2023) dan Detik News, konflik tersebut telah menyebabkan jumlah korban tewas mencapai 14.128 orang, termasuk 5.600 anak-anak. Anak-anak menjadi kelompok yang paling rentan dan terpukul parah dalam konflik ini. Program donasi ini bertujuan untuk memberikan bantuan kemanusiaan yang mencakup kebutuhan dasar seperti makanan, air bersih, perlindungan, dan layanan kesehatan bagi anak-anak yang terdampak.</p><p>&nbsp;</p><figure class="image"><img style="aspect-ratio:696/464;" src="http://localhost:8000/media/content-web-donation-2_1705556543.jpg" width="696" height="464"></figure><p>&nbsp;</p><p>Donasi yang diberikan dapat membantu memberikan perlindungan dan mendukung pemulihan anak-anak Palestina yang terluka baik secara fisik maupun emosional akibat konflik berkepanjangan. Dengan partisipasi dalam program donasi ini, kita dapat bersama-sama membantu menciptakan lingkungan yang lebih aman dan mendukung perkembangan anak-anak, sehingga mereka dapat memiliki masa depan yang lebih baik meskipun menghadapi tantangan besar akibat konflik yang melibatkan mereka secara tidak bersalah.</p>'
        ]);
    }
}
