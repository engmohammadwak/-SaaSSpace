<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\PricingPlan;
use App\Models\Client;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services'     => Service::count(),
            'projects'     => Project::count(),
            'testimonials' => Testimonial::count(),
            'pricing'      => PricingPlan::count(),
            'clients'      => Client::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
