<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@danone.co.id'],
            [
                'name' => 'Admin Danone',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'customer@danone.co.id'],
            [
                'name' => 'Customer Danone',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@nordichome.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'customer@nordichome.test'],
            [
                'name' => 'Customer',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );
    }
}
