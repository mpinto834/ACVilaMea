<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jogador;
use Illuminate\Support\Facades\Schema;

class JogadorSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Jogador::truncate();

        // Guarda Redes
        $jogadores = [
            [
                'nome' => 'João Silva',
                'numero' => 1,
                'posicao' => 'Guarda Redes',
                'foto' => 'jogadores/gr1.jpg',
            ],
            [
                'nome' => 'Pedro Costa',
                'numero' => 12,
                'posicao' => 'Guarda Redes',
                'foto' => 'jogadores/gr2.jpg',
            ],

            // Defesas
            [
                'nome' => 'Miguel Santos',
                'numero' => 2,
                'posicao' => 'Defesa',
                'foto' => 'jogadores/def1.jpg',
            ],
            [
                'nome' => 'André Oliveira',
                'numero' => 3,
                'posicao' => 'Defesa',
                'foto' => 'jogadores/def2.jpg',
            ],
            [
                'nome' => 'Ricardo Pereira',
                'numero' => 4,
                'posicao' => 'Defesa',
                'foto' => 'jogadores/def3.jpg',
            ],
            [
                'nome' => 'Tiago Fernandes',
                'numero' => 5,
                'posicao' => 'Defesa',
                'foto' => 'jogadores/def4.jpg',
            ],
            [
                'nome' => 'Bruno Alves',
                'numero' => 6,
                'posicao' => 'Defesa',
                'foto' => 'jogadores/def5.jpg',
            ],

            // Médios
            [
                'nome' => 'Rui Costa',
                'numero' => 8,
                'posicao' => 'Médio',
                'foto' => 'jogadores/med1.jpg',
            ],
            [
                'nome' => 'Daniel Sousa',
                'numero' => 10,
                'posicao' => 'Médio',
                'foto' => 'jogadores/med2.jpg',
            ],
            [
                'nome' => 'Paulo Ferreira',
                'numero' => 15,
                'posicao' => 'Médio',
                'foto' => 'jogadores/med3.jpg',
            ],
            [
                'nome' => 'Carlos Santos',
                'numero' => 16,
                'posicao' => 'Médio',
                'foto' => 'jogadores/med4.jpg',
            ],
            [
                'nome' => 'Marco Silva',
                'numero' => 18,
                'posicao' => 'Médio',
                'foto' => 'jogadores/med5.jpg',
            ],

            // Avançados
            [
                'nome' => 'Diogo Gomes',
                'numero' => 7,
                'posicao' => 'Avançado',
                'foto' => 'jogadores/av1.jpg',
            ],
            [
                'nome' => 'Hugo Almeida',
                'numero' => 9,
                'posicao' => 'Avançado',
                'foto' => 'jogadores/av2.jpg',
            ],
            [
                'nome' => 'Nuno Santos',
                'numero' => 11,
                'posicao' => 'Avançado',
                'foto' => 'jogadores/av3.jpg',
            ],
            [
                'nome' => 'Luis Martins',
                'numero' => 17,
                'posicao' => 'Avançado',
                'foto' => 'jogadores/av4.jpg',
            ],
            [
                'nome' => 'António Mendes',
                'numero' => 20,
                'posicao' => 'Avançado',
                'foto' => 'jogadores/av5.jpg',
            ],
        ];

        foreach ($jogadores as $jogador) {
            Jogador::create($jogador);
        }

        Schema::enableForeignKeyConstraints();
    }
} 