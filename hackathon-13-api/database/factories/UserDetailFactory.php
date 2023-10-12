<?php

namespace Database\Factories;

use App\Enums\UserGender;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'agency_name' => 'Kelompok 13',
            'position' => 'Karyawan Tetap',
            'gender' => UserGender::MALE,
            'place_of_birth' => $this->faker->city(),
            'date_of_birth' => now(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
        ];
    }
}
