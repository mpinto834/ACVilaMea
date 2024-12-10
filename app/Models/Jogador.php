<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jogador extends Model
{
    protected $fillable = [
        'nome',
        'numero',
        'posicao',
        'foto'
    ];

    protected $table = 'jogadores';
}
