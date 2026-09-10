<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::create([
            'code' => 'NORDIC10',
            'discount_type' => 'percentage',
            'discount_value' => 10,
            'min_purchase' => 100,
            'start_date' => Carbon::now()->subDays(10),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Coupon::create([
            'code' => 'WELCOME20',
            'discount_type' => 'percentage',
            'discount_value' => 20,
            'min_purchase' => 200,
            'start_date' => Carbon::now()->subDays(30),
            'end_date' => Carbon::now()->addDays(30),
            'is_active' => true,
        ]);

        Coupon::create([
            'code' => 'FLAT50',
            'discount_type' => 'fixed',
            'discount_value' => 50,
            'min_purchase' => 300,
            'start_date' => Carbon::now()->subDays(5),
            'end_date' => Carbon::now()->addDays(15),
            'is_active' => true,
        ]);

        Coupon::create([
            'code' => 'SUMMER15',
            'discount_type' => 'percentage',
            'discount_value' => 15,
            'min_purchase' => null,
            'start_date' => Carbon::now()->subDays(90),
            'end_date' => Carbon::now()->subDays(60),
            'is_active' => false,
        ]);
    }
}
