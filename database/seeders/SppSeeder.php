<?php

namespace Database\Seeders;

use App\Models\Spp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spp = [
            [
                'tahun_ajaran' => '2022',
                'kelas' => '10',
                'total_tagihan' => '350000',
            ],
            [
                'tahun_ajaran' => '2022',
                'kelas' => '11',
                'total_tagihan' => '325000',
            ],
            [
                'tahun_ajaran' => '2022',
                'kelas' => '12',
                'total_tagihan' => '275000',
            ],
        ];
        Spp::insert($spp);
    }
}
