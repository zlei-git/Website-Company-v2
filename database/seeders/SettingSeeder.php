<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'company_name' => 'Danone Global Food & Nutrition',
            'company_email' => 'contact@danone.com',
            'company_phone' => '+33 (0) 1 44 35 20 20',
            'company_address' => '17 Boulevard Haussmann, 75009 Paris, France',
            'business_hours' => 'Mon - Fri: 8:30 AM - 6:30 PM CET (Global Consumer Care)',
            'social_instagram' => 'https://instagram.com/lifeatdanone',
            'social_facebook' => 'https://facebook.com/danone',
            'social_pinterest' => 'https://linkedin.com/company/danone',
            'social_twitter' => 'https://twitter.com/danone',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
