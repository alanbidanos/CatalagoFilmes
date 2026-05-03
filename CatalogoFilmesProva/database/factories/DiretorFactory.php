<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;


class DiretorFactory extends Factory
{
    public function definition(): array
    {
        $nascimento = $this->faker->dateTimeBetween('1950-01-01', '2026-12-31')->format('Y-m-d');
        return [
            'nome' => $this->faker->name,
            'foto' => $this->gerarFoto(),
            'nascimento' => $nascimento,
            'idade' => now()->year - (int) substr($nascimento, 0, 4),
            'pais' => $this->faker->country,
        ];
    }


    private function gerarFoto(): string
{
    $pasta    = 'imagem/diretores';
    $filename = $this->faker->uuid() . '.jpg';

    $gender = $this->faker->randomElement(['men', 'women']);
    $number = $this->faker->numberBetween(1, 99);
    $url    = "https://randomuser.me/api/portraits/{$gender}/{$number}.jpg";

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
