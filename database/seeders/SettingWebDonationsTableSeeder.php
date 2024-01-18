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
            'title' => 'BANTU PALESTINA BANGKIT',
            'thumbnail' => 'https://donasipalestina.id/wp-content/uploads/2021/05/Banner-Bantu-Gaza-Kembali-Bangkit-11.jpg',
            'description' =>
            '
            Seolah ditutup dari fakta yang ada, kekejaman yang dialami oleh saudara-saudara kita di Palestina jauh lebih parah dari yang terpampang di media.

Rumah, bangunan dan tempat ibadah di hancurkan, anak-anak sekolah diserang, bahkan Masjid Al Aqsa, masjid suci umat muslim pun turut serta dinodai!


Tidak hanya fisik bangunan saja, namun juga manusia di dalamnya. Berbeda dengan bangunan yang dapat disusun ulang kembali, mereka yang terluka dan kehilangan bagian tubuhnya hanya dapat berharap beradaptasi dengan cepat sehingga dapat melanjutkan kehidupannya lebih baik.

Perang antara Palestina dan Israel terjadi sejak hari Sabtu (07/10). Hingga hari senin setidaknya lebih dari 400 korban meninggal dan 2000 orang luka-luka.


Aman Palestin berkomitmen untuk membantu Gaza kembali bangkit melalui program-program seperti sewa rumah sementara untuk keluarga yang terdampak, perabotan, renovasi, alat kebersihan, bahan pangan, makanan hangat, pakaian, selimut hingga bantuan medis.

Sobat Palestina sekalian, mari langitkan doa serta tunjukan kepedulian kita untuk sesama saudara nun jauh di sana dengan bersedekah. Semoga Allah karuniakan kemenangan dan ganjaran besar untuk kita sekalian dengan wasilah membantu negeri yang penuh berkah, Palestina!
            '
        ]);
    }
}
