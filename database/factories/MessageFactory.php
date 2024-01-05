<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'connect_id' => fake()->numberBetween(1,100),
            'role_pengirim' => fake()->randomElement(['User', 'Dokter']),
            'pesan' => fake()->paragraph(fake()->numberBetween(1,10)),
        ];
    }
}
