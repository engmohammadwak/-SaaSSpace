<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $plans = PricingPlan::get();
        return view('admin.pricing.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.pricing.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'billing_period' => 'required|string|max:50',
            'features'       => 'required|string',
            'btn_text'       => 'required|string|max:255',
            'btn_url'        => 'required|string|max:255',
            'is_featured'    => 'nullable|boolean',
            'is_active'      => 'nullable|boolean',
        ]);

        $validated['features']    = array_map('trim', explode('\n', $validated['features']));
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active']   = $request->has('is_active');

        PricingPlan::create($validated);
        return redirect()->route('admin.pricing.index')->with('success', 'Plan created!');
    }

    public function edit(PricingPlan $pricing)
    {
        return view('admin.pricing.edit', compact('pricing'));
    }

    public function update(Request $request, PricingPlan $pricing)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'billing_period' => 'required|string|max:50',
            'features'       => 'required|string',
            'btn_text'       => 'required|string|max:255',
            'btn_url'        => 'required|string|max:255',
            'is_featured'    => 'nullable|boolean',
            'is_active'      => 'nullable|boolean',
        ]);

        $validated['features']    = array_map('trim', explode('\n', $validated['features']));
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active']   = $request->has('is_active');

        $pricing->update($validated);
        return redirect()->route('admin.pricing.index')->with('success', 'Plan updated!');
    }

    public function destroy(PricingPlan $pricing)
    {
        $pricing->delete();
        return redirect()->route('admin.pricing.index')->with('success', 'Plan deleted!');
    }
}
