<?php

namespace Database\Factories;

use App\Models\Estudio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * @extends Factory<Estudio>
 */
class EstudioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nomec = fake()->company();
        return [
            'nome' => $nomec,
            'logo' => $this->gerarLogo($nomec),
            'ano_fundacao' => $this->faker->numberBetween(1900, 2023),
            'pais_fundacao' => $this->faker->country,
        ];
    }

    private function gerarLogo(string $nome): string
{
    $pasta    = 'imagem/estudios';
    $filename = $this->faker->uuid() . '.png';

    $iniciais = collect(explode(' ', $nome))
        ->take(2)
        ->map(fn($palavra) => strtoupper($palavra[0]))
        ->join('');

    $cor     = ltrim($this->faker->hexColor(), '#');
    $url     = "https://ui-avatars.com/api/?name={$iniciais}&background={$cor}&color=fff&size=200&bold=true&format=png";

    try {
        $response = Http::timeout(10)->get($url);

        if ($response->successful()) {
            Storage::disk('public')->put("{$pasta}/{$filename}", $response->body());
            return "{$pasta}/{$filename}";
        }
    } catch (\Exception $e) {
        //PREGUIÇA
    }

    return $url;
}
}
