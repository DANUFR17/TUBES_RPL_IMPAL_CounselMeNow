<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role' => fake()->randomElement(['User', 'Dokter']),
            'foto_profil' => fake()->imageUrl(),
            'name' => function (array $data) {
                return $data['role'] === 'Dokter' ? 'Dr.'.fake()->name() : fake()->name();
            },
            'tgl_lahir' => fake()->date(),
            'no_hp' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'spesialis' => function (array $data) {
                return $data['role'] === 'Dokter' ? fake()->randomElement(['Gigi', 'Organ Dalam', 'Umum', 'THT']) : null;
            },
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
