<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        $hero = HeroSection::firstOrCreate([], [
            'badge_text'         => 'Available for New Projects',
            'main_title'         => 'We Craft High-Impact Designs for',
            'rotating_texts'     => ['SaaS Products', 'AI Products', 'FinTech', 'E-Commerce', 'Real Estate', 'EdTech', 'MedTech'],
            'description'        => 'We help SaaS companies with UI/UX, frontend development, branding, and web design that drive growth.',
            'primary_btn_text'   => 'Book a Call',
            'primary_btn_url'    => 'https://calendly.com/hello-saasspace/new-meeting',
            'secondary_btn_text' => 'Case Studies',
            'secondary_btn_url'  => 'https://www.behance.net/saasspacellc',
        ]);

        return view('admin.hero.index', compact('hero'));
    }

    public function edit($id)
    {
        $hero = HeroSection::findOrFail($id);
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, $id)
    {
        $hero = HeroSection::findOrFail($id);

        $validated = $request->validate([
            'badge_text'         => 'required|string|max:255',
            'main_title'         => 'required|string|max:255',
            'rotating_texts'     => 'required|string',
            'description'        => 'required|string',
            'primary_btn_text'   => 'required|string|max:255',
            'primary_btn_url'    => 'required|url',
            'secondary_btn_text' => 'required|string|max:255',
            'secondary_btn_url'  => 'required|url',
        ]);

        $validated['rotating_texts'] = array_map('trim', explode('\n', $validated['rotating_texts']));

        $hero->update($validated);

        return redirect()->route('admin.hero.index')->with('success', 'Hero section updated successfully!');
    }
}
