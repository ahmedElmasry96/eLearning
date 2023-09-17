<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            'website_name' => 'eLEARNING',
            'logo' => 'website/img/logo.png',
            'address' => '123 Street, New York, USA',
            'phone' => '+012 345 67890',
            'email' => 'info@example.com',
            'copyright' => 'eLEARNING All Right Reserved.',
            'facebook' => 'https://www.facebook.com/ddd',
            'twitter' => 'https://www.twitter.com/ddd',
            'instagram' => 'https://www.instagram.com/ddd',
            'youtube' => 'https://www.youtube.com/ddd',
            'linkedin' => 'https://www.linkedin.com/ddd',
        ];

        Setting::create($settings);
        
    }
}
