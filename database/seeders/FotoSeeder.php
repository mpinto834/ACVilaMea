<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Foto;
use Symfony\Component\String\TruncateMode;

class FotoSeeder extends Seeder
{
    public function run()
    {
        Foto::truncate();
        $fotos = [
            [
                'imagem' => 'images/campo.png',
                'legenda' => 'Treino da Equipe'
            ],
            [
                'imagem' => 'images/campo.png',
                'legenda' => 'Último Jogo'
            ],
            [
                'imagem' => 'images/campo.png',
                'legenda' => 'Evento com Adeptos'
            ],
        ];

        foreach ($fotos as $foto) {
            Foto::create($foto);
        }
    }
} 