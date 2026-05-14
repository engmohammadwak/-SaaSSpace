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
        $services = Service::ordered()->get();
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
            'icon'        => 'nullable|image|mimes:webp,png,jpg,svg|max:2048',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        if ($request->hasFile('icon')) {
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created!');
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
            'icon'        => 'nullable|image|mimes:webp,png,jpg,svg|max:2048',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        if ($request->hasFile('icon')) {
            if ($service->icon) Storage::disk('public')->delete($service->icon);
            $validated['icon'] = $request->file('icon')->store('services', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated!');
    }

    public function destroy(Service $service)
    {
        if ($service->icon) Storage::disk('public')->delete($service->icon);
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted!');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Service::where('id', $id)->update(['sort_order' => $index]);
        }
        return response()->json(['success' => true]);
    }
}
