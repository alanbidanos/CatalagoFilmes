<?php

namespace Database\Factories;

use App\Models\Diretor;
use Illuminate\Database\Eloquent\Factories\Factory;


class FilmeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'capa' => null,
            'ano' => $this->faker->numberBetween(1950, 2026),
            'duracao' => $this->faker->time('H:i:s'),
            'nota' => $this->faker->numberBetween(1, 10),
            'genero' => $this->faker->text(10),
            'diretores_id' => (Diretor::All()->random())->id,
        ];
    }
}
