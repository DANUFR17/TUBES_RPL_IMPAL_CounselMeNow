<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TicketOnsite>
 */
class TicketOnsiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'connect_id' => fake()->numberBetween(1, 100),
            'tanggal' => fake()->date(),
            'jam' => fake()->time(),
            'keluhan' => fake()->paragraph(fake()->numberBetween(1,10)),
            'access' => fake()->boolean(),
        ];
    }
}
