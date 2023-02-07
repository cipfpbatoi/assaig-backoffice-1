<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserva>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nombre'=> fake()->name(),
            'email'=> fake()->unique()->safeEmail(),
            'telefono'=> fake()->phoneNumber(),
            'comensales'=> fake()->unique()->numberBetween(5,7),
            'obervaciones' => fake()->sentence(2),
            'localizador' => fake()->lexify('???'),
            'confirmado' => fake()->boolean(),

        ];
    }
}
