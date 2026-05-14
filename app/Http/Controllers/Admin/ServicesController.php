<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->orderBy('created_at')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|image|max:2048',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $validated['is_active']   = $request->boolean('is_active');
        $validated['sort_order']  = $request->input('sort_order', 0);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully!');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|image|max:2048',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $validated['is_active']  = $request->boolean('is_active');
        $validated['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('icon')) {
            if ($service->icon) Storage::disk('public')->delete($service->icon);
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully!');
    }

    public function destroy(Service $service)
    {
        if ($service->icon) Storage::disk('public')->delete($service->icon);
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted.');
    }
}
