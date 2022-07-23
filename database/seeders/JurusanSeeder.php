<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan = [
            [
                'name' => 'Perawat',
            ],
            [
                'name' => 'Farmasi',
            ],
            [
                'name' => 'Otomotif Sepeda Motor',
            ],
            [
                'name' => 'Teknik Komputer Jaringan',
            ],
        ];
        Jurusan::insert($jurusan);
    }
}
