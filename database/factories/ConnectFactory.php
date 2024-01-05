<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Connect;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Connect>
 */
class ConnectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::where('role', 'User')->inRandomOrder()->first();
        $dokter = User::where('role', 'Dokter')->inRandomOrder()->first();

        return [
            'pasien_id' => $user->id,
            'dokter_id' => $dokter->id
        ];
    }
}
