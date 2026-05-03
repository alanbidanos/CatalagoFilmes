<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudio extends Model
{
    protected $table = 'estudio';   
    /** @use HasFactory<\Database\Factories\EstudioFactory> */
    use HasFactory;
    protected $fillable = [
        'nome',
        'logo',
        'ano_fundacao',
        'pais_fundacao'
    ];
}
