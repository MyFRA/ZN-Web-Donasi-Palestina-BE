<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::create([
            'slug' => Str::slug('Potret Wajah Murung Anak-Anak Palestina Menahan Lapar'),
            'title' => 'Potret Wajah Murung Anak-Anak Palestina Menahan Lapar',
            'subtitle' => 'Sejumlah anak dan warga Palestina mengalami kelaparan akibat truk pengiriman bantuan terhambat bahkan dijarah. ',
            'content' => '<p>&nbsp;</p><figure class="image"><img style="aspect-ratio:800/451;" src="http://localhost:8000/media/news_1705556730.jpeg" width="800" height="451"></figure><p>&nbsp;</p><p>Kelaparan telah menjadi salah satu masalah paling mendesak di antara berbagai masalah yang dihadapi ratusan ribu warga Palestina di Gaza yang terdispersi, dengan truk bantuan hanya mampu membawa sebagian kecil dari kebutuhan, dan distribusi yang tidak merata akibat kekacauan perang.</p>'
        ]);
    }
}
