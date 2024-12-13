<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'preco',
        'imagem',
        'tipo_artigo_id',
        'tamanhos_stock'
    ];

    public function tipoArtigo()
    {
        return $this->belongsTo(TipoArtigo::class, 'tipo_artigo_id');
    }
} 