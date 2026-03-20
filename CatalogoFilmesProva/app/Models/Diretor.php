<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diretor extends Model
{
    protected $table = 'diretores';
    use HasFactory;
    protected $fillable = [
        'nome',
        'foto',
        'nascimento',
        'idade',
        'pais'
    ];
}
