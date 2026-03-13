<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Diretor;

class DiretorSeeder extends Seeder
{
    public function run(): void
    {
        Diretor::factory()->count(10)->create();
    }
}
