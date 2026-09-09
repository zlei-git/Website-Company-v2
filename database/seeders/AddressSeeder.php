<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\User;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Address::factory()->create([
                'user_id' => $user->id,
                'is_default' => true,
            ]);

            if (rand(0, 1)) {
                Address::factory()->create([
                    'user_id' => $user->id,
                    'is_default' => false,
                ]);
            }
        }
    }
}
