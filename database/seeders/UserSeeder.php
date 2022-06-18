<?php

namespace Database\Seeders;

use App\Models\Periode;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Si Paling Admin',
            'email' => 'admin@gmail.com',
            'role' => 'Admin',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'name' => 'Si Paling User',
            'email' => 'user@gmail.com',
            'role' => 'Siswa',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        Periode::create([
            'name' => 'Januari',
            'tanggal_mulai' => '2022-01-01',
            'tanggal_akhir' => '2022-01-31',
        ]);
        Periode::create([
            'name' => 'Februari',
            'tanggal_mulai' => '2022-02-01',
            'tanggal_akhir' => '2022-02-28',
        ]);
        Periode::create([
            'name' => 'Maret',
            'tanggal_mulai' => '2022-03-01',
            'tanggal_akhir' => '2022-03-31',
        ]);
        Periode::create([
            'name' => 'April',
            'tanggal_mulai' => '2022-04-01',
            'tanggal_akhir' => '2022-04-30',
        ]);
        Periode::create([
            'name' => 'Mei',
            'tanggal_mulai' => '2022-05-01',
            'tanggal_akhir' => '2022-05-31',
        ]);
        Periode::create([
            'name' => 'Juni',
            'tanggal_mulai' => '2022-06-01',
            'tanggal_akhir' => '2022-06-30',
        ]);
        Periode::create([
            'name' => 'Juli',
            'tanggal_mulai' => '2022-07-01',
            'tanggal_akhir' => '2022-07-31',
        ]);
        Periode::create([
            'name' => 'Agustus',
            'tanggal_mulai' => '2022-08-01',
            'tanggal_akhir' => '2022-08-31',
        ]);
        Periode::create([
            'name' => 'September',
            'tanggal_mulai' => '2022-09-01',
            'tanggal_akhir' => '2022-09-30',
        ]);
        Periode::create([
            'name' => 'Oktober',
            'tanggal_mulai' => '2022-10-01',
            'tanggal_akhir' => '2022-10-31',
        ]);
        Periode::create([
            'name' => 'November',
            'tanggal_mulai' => '2022-11-01',
            'tanggal_akhir' => '2022-11-30',
        ]);
        Periode::create([
            'name' => 'Desember',
            'tanggal_mulai' => '2022-12-01',
            'tanggal_akhir' => '2022-12-31',
        ]);
    }
}
