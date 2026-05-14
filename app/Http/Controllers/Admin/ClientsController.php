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
        $clients = Client::orderBy('sort_order')->orderBy('created_at')->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'logo'       => 'required|image|max:2048',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        Client::create([
            'name'       => $request->name,
            'logo'       => $request->file('logo')->store('clients', 'public'),
            'sort_order' => $request->input('sort_order', 0),
            'is_active'  => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client logo added!');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'logo'       => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data = [
            'name'       => $request->name,
            'sort_order' => $request->input('sort_order', 0),
            'is_active'  => $request->boolean('is_active'),
        ];

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($client->logo);
            $data['logo'] = $request->file('logo')->store('clients', 'public');
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client updated!');
    }

    public function destroy(Client $client)
    {
        Storage::disk('public')->delete($client->logo);
        $client->delete();

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client deleted.');
    }
}
