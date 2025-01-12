<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            NewsSeeder::class,
            JogadorSeeder::class,
            GameSeeder::class,
            FotoSeeder::class,
            UserSeeder::class,
        ]);
    }
}
