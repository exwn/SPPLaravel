<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $role = $this->faker->numberBetween(1, 3);
        $role = 3;
        if ($role == '3') {
            $kelas = $this->faker->numberBetween(1, 3);
            $jurusan = $this->faker->numberBetween(1, 4);
        }
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'no_telp' => $this->faker->numerify('#############'),
            'role_id' => $role,
            'kelas_id' => $kelas,
            'jurusan_id' => $jurusan,
        ];
    }
}
