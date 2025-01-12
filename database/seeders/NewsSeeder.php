<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run()
    {
        News::truncate();

        $noticias = [
            [
                'title' => 'Vitória épica na última jornada',
                'content' => 'A equipe conquistou uma vitória importante no último domingo...',
                'image' => 'noticias/noticia1.jpg',
            ],
            [
                'title' => 'Novo reforço chega ao clube',
                'content' => 'O clube anuncia a contratação de um novo jogador...',
                'image' => 'noticias/noticia2.jpg',
            ],
            [
                'title' => 'Equipe intensifica preparação',
                'content' => 'A equipe está em preparação intensiva para o próximo desafio...',
                'image' => 'noticias/noticia3.jpg',
            ],
            [
                'title' => 'Treino especial com adeptos',
                'content' => 'Jogadores participaram de um treino especial com presença dos adeptos...',
                'image' => 'noticias/noticia4.jpg',
            ],
            [
                'title' => 'Análise tática do próximo adversário',
                'content' => 'Equipe técnica prepara estratégia especial para o próximo jogo...',
                'image' => 'noticias/noticia5.jpg',
            ],
        ];

        foreach ($noticias as $noticia) {
            News::create($noticia);
        }
    }
} 