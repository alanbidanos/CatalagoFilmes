<?php

namespace Database\Factories;

use App\Models\Filme;
use Illuminate\Database\Eloquent\Factories\Factory;


class AvaliacaoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'usuario' => $this->faker->name,
            'filmes_id' => (Filme::All()->random())->id,
            'comentario' => $this->faker->text(100),
            'nota' => $this->faker->numberBetween(1, 10),
        ];
    }
}
