<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Filme extends Model
{
    protected $table = 'filmes';
    use HasFactory;
    protected $fillable = [
        'nome',
        'ano',
        'duracao',
        'nota',
        'genero',
        'diretores_id'
    ];
}




