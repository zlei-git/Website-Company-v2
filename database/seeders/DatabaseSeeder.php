<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            CollectionSeeder::class,
            AddressSeeder::class,
            CouponSeeder::class,
            OrderSeeder::class,
            ReviewSeeder::class,
            InspirationSeeder::class,
            MessageSeeder::class,
            NewsletterSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
