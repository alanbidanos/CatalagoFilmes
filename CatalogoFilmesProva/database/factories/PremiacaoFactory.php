<?php

namespace Database\Factories;

use App\Models\Premiacao;
use App\Models\Filme;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Premiação>
 */
class PremiacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $filmesdispo = null;

    public function definition(): array
    {
        if (static::$filmesdispo === null) {
            static::$filmesdispo = Filme::pluck('id')->shuffle(); //cria um array pucxando os ids dos filmes e embaralha
        }

        $filmeid = static::$filmesdispo->shift(); // pega primeiro e remove pra n repetir

        return [
            'nome'      => $this->faker->lastName(),
            'filmes_id' => $filmeid,
            'ano'       => $this->faker->numberBetween(1950, 2026),
        ];
    }
}
