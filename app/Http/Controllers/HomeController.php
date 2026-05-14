<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\Service;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\PricingPlan;
use App\Models\Client;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $hero        = HeroSection::first();
        $services    = Service::active()->ordered()->get();
        $projects    = Project::active()->ordered()->get();
        $testimonials = Testimonial::active()->get();
        $pricingPlans = PricingPlan::active()->get();
        $clients     = Client::active()->ordered()->get();
        $settings    = SiteSetting::pluck('value', 'key');

        return view('home', compact(
            'hero', 'services', 'projects',
            'testimonials', 'pricingPlans', 'clients', 'settings'
        ));
    }
}
