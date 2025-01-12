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
                'imagem' => 'galeria/foto1.jpg',
                'legenda' => 'Treino da Equipe'
            ],
            [
                'imagem' => 'galeria/foto2.jpg',
                'legenda' => 'Último Jogo'
            ],
            [
                'imagem' => 'galeria/foto3.jpg',
                'legenda' => 'Evento com Adeptos'
            ],
        ];

        foreach ($fotos as $foto) {
            Foto::create($foto);
        }
    }
} 