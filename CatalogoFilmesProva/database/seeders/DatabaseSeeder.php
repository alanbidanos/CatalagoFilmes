<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AvaliacaoSeeder;
use Database\Seeders\DiretorSeeder;
use Database\Seeders\FilmeSeeder;
use Database\Seeders\PremiacaoSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
    $this->call([
        DiretorSeeder::class,
        FilmeSeeder::class,
        AvaliacaoSeeder::class,
        PremiacaoSeeder::class,
    ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
