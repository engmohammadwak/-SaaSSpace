<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSection;
use App\Models\SiteSetting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Hero Section
        if (HeroSection::count() === 0) {
            HeroSection::create([
                'main_title'          => 'We Craft High-Impact Designs for',
                'rotating_words'      => ['SaaS Startups', 'Creative Brands', 'Digital Products', 'Tech Companies'],
                'description'         => 'We help ambitious brands stand out with stunning UI/UX design, motion graphics, and brand identity — built to convert.',
                'primary_btn_text'    => 'Start a Project',
                'primary_btn_url'     => '#contact',
                'secondary_btn_text'  => 'View Our Work',
                'secondary_btn_url'   => '#projects',
                'video_url'           => null,
                'is_active'           => true,
            ]);
        }

        // Site Settings
        $defaults = [
            'site_name'         => 'SaaSSpace',
            'tagline'           => 'Design That Converts',
            'email'             => 'hello@saasspace.co',
            'phone'             => '+1 (555) 000-0000',
            'twitter_url'       => 'https://twitter.com/saasspace',
            'linkedin_url'      => 'https://linkedin.com/company/saasspace',
            'behance_url'       => 'https://behance.net/saasspace',
            'instagram_url'     => 'https://instagram.com/saasspace',
            'footer_text'       => '© 2025 SaaSSpace. All rights reserved.',
        ];

        foreach ($defaults as $key => $value) {
            SiteSetting::firstOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
