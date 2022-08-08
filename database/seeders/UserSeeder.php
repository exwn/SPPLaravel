<?php

namespace Database\Seeders;

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
        $users = [
            [
                'name' => 'Si Paling Admin',
                'email' => 'admin@gmail.com',
                'role_id' => 1,
                'kelas_id' => null,
                'jurusan_id' => null,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Si Paling Tata Usaha',
                'email' => 'tatausaha@gmail.com',
                'role_id' => 2,
                'kelas_id' => null,
                'jurusan_id' => null,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Si Paling Pelajar',
                'email' => 'pelajar@gmail.com',
                'role_id' => 3,
                'kelas_id' => 3,
                'jurusan_id' => 3,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ],
        ];
        User::insert($users);
    }
}
