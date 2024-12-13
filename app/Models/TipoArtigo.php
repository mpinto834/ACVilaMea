<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoArtigo extends Model
{
    use HasFactory;

    protected $table = 'tipos_artigos';
    protected $fillable = ['nome', 'tem_tamanho'];

    public function artigos()
    {
        return $this->hasMany(Artigo::class);
    }
} 