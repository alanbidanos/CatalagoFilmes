<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class DiretorFactory extends Factory
{
    public function definition(): array
    {
        $nascimento = $this->faker->numberBetween(1900, 2026);
        return [
            'nome' => $this->faker->name,
            'nascimento' => $nascimento,
            'idade' => now()->year - $nascimento,
            'pais' => $this->faker->country,
        ];
    }
}
