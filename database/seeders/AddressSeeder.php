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
            Address::create([
                'user_id' => $user->id,
                'label' => 'Rumah',
                'full_name' => $user->name,
                'phone' => '08123456789',
                'address' => 'Jl. Jenderal Sudirman No. 45',
                'city' => 'Jakarta Selatan',
                'state' => 'DKI Jakarta',
                'postal_code' => '12190',
                'country' => 'Indonesia',
                'is_default' => true,
            ]);
        }
    }
}
