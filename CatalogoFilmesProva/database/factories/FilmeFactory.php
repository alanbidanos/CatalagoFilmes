<?php

namespace Database\Factories;

use App\Models\Diretor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FilmeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome'         => $this->faker->sentence(3),
            'capa'         => $this->gerarCapa(),
            'ano'          => $this->faker->numberBetween(1950, 2026),
            'duracao'      => $this->faker->time('H:i'),
            'nota'         => $this->faker->numberBetween(1, 5),
            'genero'       => $this->faker->word(),
            'diretores_id' => Diretor::all()->random()->id,
        ];
    }

    private function gerarCapa(): string
    {
        $pasta    = 'imagem/filmes';
        $filename = $this->faker->uuid() . '.jpg';
        $seed     = $this->faker->numberBetween(1, 1000);

        $response = Http::get("https://picsum.photos/seed/{$seed}/400/600");

        Storage::disk('public')->put("{$pasta}/{$filename}", $response->body());

        return "{$pasta}/{$filename}";
    }
}