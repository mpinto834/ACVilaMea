<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();

        $faker = Faker::create('pt_PT');

        // Admin
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Principal',
            'username' => 'admin',
            'email' => 'admin@acvilamea.pt',
            'password' => Hash::make('admin@acvilamea.pt'),
            'birth_date' => '1990-01-01',
            'phone_number' => '912345678',
            'profile_photo' => 'users/default.jpg',
            'role' => 2,
            'email_verified_at' => now()
        ]);

        // Criar 50 usuários normais aleatórios
        for ($i = 0; $i < 50; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;
            
            User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => strtolower($firstName . '_' . $lastName . rand(1, 99)),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'), // senha padrão para todos os usuários
                'birth_date' => $faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
                'phone_number' => $faker->numerify('9########'),
                'profile_photo' => 'users/default.jpg',
                'role' => 0,
                'email_verified_at' => now()
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
} 