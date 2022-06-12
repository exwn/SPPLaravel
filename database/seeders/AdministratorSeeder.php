<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\Models\User;
        $administrator->name = "Si Paling Admin";
        $administrator->email = "sipalingadmin@gmail.com";
        $administrator->roles = 1;
        $administrator->password = \Hash::make("password");
        $administrator->save();
        $this->command->info("User Admin berhasil diinsert");
    }
}
