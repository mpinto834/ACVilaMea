<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;
use Illuminate\Support\Facades\Schema;

class GameSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Game::truncate();

        $jogos = [
            [
                'game_type' => 'home',
                'team1_name' => 'AC Vila Meã',
                'team1_photo' => 'images/AC-VILA-MEA.ico',
                'team2_name' => 'FC Porto',
                'team2_photo' => 'storage/team_photos/porto.jpg',
                'location' => 'Estádio Municipal de Vila Meã',
                'date_time' => now()->addDays(5)->format('Y-m-d H:i:s'),
                'result' => null
            ],
            [
                'game_type' => 'away',
                'team1_name' => 'Benfica',
                'team1_photo' => 'storage/team_photos/benfica.jpg',
                'team2_name' => 'AC Vila Meã',
                'team2_photo' => 'images/AC-VILA-MEA.ico',
                'location' => 'Estádio da Luz',
                'date_time' => now()->addDays(12)->format('Y-m-d H:i:s'),
                'result' => null
            ],
            [
                'game_type' => 'home',
                'team1_name' => 'AC Vila Meã',
                'team1_photo' => 'images/AC-VILA-MEA.ico',
                'team2_name' => 'Sporting CP',
                'team2_photo' => 'storage/team_photos/sporting.jpg',
                'location' => 'Estádio Municipal de Vila Meã',
                'date_time' => now()->addDays(19)->format('Y-m-d H:i:s'),
                'result' => null
            ],
            // Jogo passado com resultado
            [
                'game_type' => 'home',
                'team1_name' => 'AC Vila Meã',
                'team1_photo' => 'images/AC-VILA-MEA.ico',
                'team2_name' => 'Braga',
                'team2_photo' => 'storage/team_photos/braga.jpg',
                'location' => 'Estádio Municipal de Vila Meã',
                'date_time' => now()->subDays(5)->format('Y-m-d H:i:s'),
                'result' => '2-1'
            ],
        ];

        foreach ($jogos as $jogo) {
            Game::create($jogo);
        }

        Schema::enableForeignKeyConstraints();
    }
}
