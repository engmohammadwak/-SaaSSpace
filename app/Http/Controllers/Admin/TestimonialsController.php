<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialsController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name'   => 'required|string|max:255',
            'client_title'  => 'required|string|max:255',
            'client_avatar' => 'nullable|image|mimes:webp,png,jpg|max:2048',
            'content'       => 'required|string',
            'rating'        => 'required|integer|min:1|max:5',
            'is_active'     => 'nullable|boolean',
        ]);

        if ($request->hasFile('client_avatar')) {
            $validated['client_avatar'] = $request->file('client_avatar')->store('testimonials', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name'   => 'required|string|max:255',
            'client_title'  => 'required|string|max:255',
            'client_avatar' => 'nullable|image|mimes:webp,png,jpg|max:2048',
            'content'       => 'required|string',
            'rating'        => 'required|integer|min:1|max:5',
            'is_active'     => 'nullable|boolean',
        ]);

        if ($request->hasFile('client_avatar')) {
            if ($testimonial->client_avatar) Storage::disk('public')->delete($testimonial->client_avatar);
            $validated['client_avatar'] = $request->file('client_avatar')->store('testimonials', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->client_avatar) Storage::disk('public')->delete($testimonial->client_avatar);
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted!');
    }
}
