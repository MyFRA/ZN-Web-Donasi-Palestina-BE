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
            'slug' => Str::slug('PERANG BADAI AL-AQSA || Penyaluran Tahap 2'),
            'title' => 'PERANG BADAI AL-AQSA || Penyaluran Tahap 2',
            'subtitle' => 'Gaza, 10 & 11 Oktober 2023',
            'content' => 'Alhamdulillah, Aman Palestin sudah mengirimkan bantuan untuk kondisi genting yang tengah dialami di Gaza. Bantuan sebesar $ 100.000 (Rp 1.500.000.000) sudah dikirim ke kantor perwakilan kami di Gaza dan akan di salurkan untuk para korban serangan dan agresi zionis secara bertahap.
            Jazakumullah Khayran Katsiiran pada dermawan yang senantiasa berdiri tegak di barisan pembebas Palestina! Semoga menjadi Allah menerima sebagai amal ibadah dan Allah berikan balasan berlipat, Aamiin ya Rabbalalamiin'
        ]);
    }
}
