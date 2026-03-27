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

    $page    = $this->faker->numberBetween(1, 50);
    $apiKey  = config('services.tmdb.key');
    $apiUrl  = "https://api.themoviedb.org/3/movie/popular?api_key={$apiKey}&page={$page}";

    try {
        $response = Http::timeout(10)->get($apiUrl);

        if ($response->successful()) {
            $filmes   = $response->json('results');
            $filme    = collect($filmes)->random();
            $posterPath = $filme['poster_path'] ?? null;

            if ($posterPath) {
                $imageUrl = "https://image.tmdb.org/t/p/w500{$posterPath}";
                $image    = Http::timeout(10)->get($imageUrl);

                if ($image->successful()) {
                    Storage::disk('public')->put("{$pasta}/{$filename}", $image->body());
                    return "{$pasta}/{$filename}";
                }
            }
        }
    } catch (\Exception $e) {
        //PREGUIÇA
    }
    return "https://picsum.photos/seed/{$this->faker->uuid()}/400/600";
}
}
