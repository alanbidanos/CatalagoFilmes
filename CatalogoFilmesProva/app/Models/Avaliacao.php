<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Avaliacao extends Model
{
    protected $table = 'avaliacao';
    use HasFactory;
    protected $fillable = [
        'usuario',
        'filmes_id',
        'comentario',
        'nota'
    ];

    public function filme()
    {
        return $this->belongsTo(Filme::class, 'filmes_id');
    }

}

