<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = [
        'imagem',
        'legenda'
    ];

    protected $table = 'fotos';
} 