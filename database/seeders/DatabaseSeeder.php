<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\HeroSection;
use App\Models\Service;
use App\Models\SiteSetting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name'  => 'SaaSSpace Admin',
            'email' => 'admin@saasspace.co',
        ]);

        // Hero section
        HeroSection::create([
            'badge_text'         => 'Available for New Projects',
            'main_title'         => 'We Craft High-Impact Designs for',
            'rotating_texts'     => ['SaaS Products', 'AI Products', 'FinTech', 'E-Commerce', 'Real Estate', 'EdTech', 'MedTech'],
            'description'        => 'We help SaaS companies with UI/UX, frontend development, branding, and web design that drive growth.',
            'primary_btn_text'   => 'Book a Call',
            'primary_btn_url'    => 'https://calendly.com/hello-saasspace/new-meeting',
            'secondary_btn_text' => 'Case Studies',
            'secondary_btn_url'  => 'https://www.behance.net/saasspacellc',
        ]);

        // Services
        $services = [
            ['title' => 'UI/UX Design',         'description' => 'We design beautiful and intuitive user interfaces for SaaS products.',            'sort_order' => 1],
            ['title' => 'Frontend Development', 'description' => 'We build fast, responsive frontends using modern technologies.',                      'sort_order' => 2],
            ['title' => 'Branding',              'description' => 'We create memorable brands that stand out in competitive markets.',                   'sort_order' => 3],
            ['title' => 'Web Design',            'description' => 'We craft high-converting landing pages and websites for SaaS companies.',            'sort_order' => 4],
        ];
        foreach ($services as $service) {
            Service::create($service);
        }

        // Site settings
        $settings = [
            'site_name'     => 'SaaSSpace',
            'site_email'    => 'hello@saasspace.co',
            'calendly_url'  => 'https://calendly.com/hello-saasspace/new-meeting',
            'behance_url'   => 'https://www.behance.net/saasspacellc',
            'instagram_url' => 'https://www.instagram.com/saasspacellc',
            'dribbble_url'  => 'https://dribbble.com/hellorazzak',
            'footer_text'   => '© 2025 SaaSSpace. All rights reserved.',
        ];
        foreach ($settings as $key => $value) {
            SiteSetting::create(['key' => $key, 'value' => $value]);
        }
    }
}
