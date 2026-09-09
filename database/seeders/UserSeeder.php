<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin NordicHome',
            'email' => 'admin@nordichome.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Emma Lindström',
            'email' => 'customer@nordichome.test',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'customer2@nordichome.test',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);
    }
}
