<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Danone Official Accounts
        User::firstOrCreate(
            ['email' => 'admin@danone.co.id'],
            [
                'name' => 'Admin Danone Indonesia',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'customer@danone.co.id'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );

        // Fallback / legacy demo accounts
        User::firstOrCreate(
            ['email' => 'admin@nordichome.test'],
            [
                'name' => 'Admin Danone',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'customer@nordichome.test'],
            [
                'name' => 'Pelanggan Danone',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );
    }
}
