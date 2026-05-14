<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = Client::ordered()->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'logo'       => 'required|image|mimes:webp,png,jpg,svg|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        $validated['logo']      = $request->file('logo')->store('clients', 'public');
        $validated['is_active'] = $request->has('is_active');
        Client::create($validated);

        return redirect()->route('admin.clients.index')->with('success', 'Client added!');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'logo'       => 'nullable|image|mimes:webp,png,jpg,svg|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($client->logo) Storage::disk('public')->delete($client->logo);
            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $client->update($validated);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated!');
    }

    public function destroy(Client $client)
    {
        if ($client->logo) Storage::disk('public')->delete($client->logo);
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted!');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Client::where('id', $id)->update(['sort_order' => $index]);
        }
        return response()->json(['success' => true]);
    }
}
