<?php

namespace Database\Seeders;

use App\Models\VirtualBankAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VirtualBanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            [
                'bank_name' => 'BRI',
                'bank_short_code' => 'BRI'
            ],
            [
                'bank_name' => 'BNI',
                'bank_short_code' => 'BNI'
            ],
            [
                'bank_name' => 'Bank Mandiri',
                'bank_short_code' => 'MANDIRI'
            ],
            [
                'bank_name' => 'Bank CIMB Niaga',
                'bank_short_code' => 'CIMB_NIAGA'
            ],
            [
                'bank_name' => 'Bank Permata',
                'bank_short_code' => 'PERMATA'
            ],
            [
                'bank_name' => 'Bank Danamon',
                'bank_short_code' => 'DANAMON'
            ],
            [
                'bank_name' => 'BCA',
                'bank_short_code' => 'BCA'
            ],
        ];

        foreach ($banks as $bank) {
            $bank['image'] = '';
            VirtualBankAccount::create($bank);
        }
    }
}
