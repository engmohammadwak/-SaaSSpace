<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $plans = PricingPlan::orderBy('sort_order')->orderBy('price')->get();
        return view('admin.pricing.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.pricing.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'billing_period' => 'required|string|max:50',
            'features'       => 'required|string',
            'btn_text'       => 'required|string|max:100',
            'btn_url'        => 'required|string|max:500',
        ]);

        PricingPlan::create([
            'name'           => $request->name,
            'price'          => $request->price,
            'billing_period' => $request->billing_period,
            'features'       => array_filter(array_map('trim', explode("\n", $request->features))),
            'btn_text'       => $request->btn_text,
            'btn_url'        => $request->btn_url,
            'is_featured'    => $request->boolean('is_featured'),
            'is_active'      => $request->boolean('is_active'),
            'sort_order'     => $request->input('sort_order', 0),
        ]);

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Pricing plan created!');
    }

    public function edit(PricingPlan $pricing)
    {
        return view('admin.pricing.edit', compact('pricing'));
    }

    public function update(Request $request, PricingPlan $pricing)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'price'          => 'required|numeric|min:0',
            'billing_period' => 'required|string|max:50',
            'features'       => 'required|string',
            'btn_text'       => 'required|string|max:100',
            'btn_url'        => 'required|string|max:500',
        ]);

        $pricing->update([
            'name'           => $request->name,
            'price'          => $request->price,
            'billing_period' => $request->billing_period,
            'features'       => array_filter(array_map('trim', explode("\n", $request->features))),
            'btn_text'       => $request->btn_text,
            'btn_url'        => $request->btn_url,
            'is_featured'    => $request->boolean('is_featured'),
            'is_active'      => $request->boolean('is_active'),
            'sort_order'     => $request->input('sort_order', 0),
        ]);

        return redirect()->route('admin.pricing.index')
            ->with('success', 'Plan updated!');
    }

    public function destroy(PricingPlan $pricing)
    {
        $pricing->delete();
        return redirect()->route('admin.pricing.index')
            ->with('success', 'Plan deleted.');
    }
}
