<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')->orderBy('created_at')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|max:4096',
            'url'         => 'nullable|url|max:500',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $validated['is_active']  = $request->boolean('is_active');
        $validated['sort_order'] = $request->input('sort_order', 0);
        $validated['image']      = $request->file('image')->store('projects', 'public');

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project added successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:4096',
            'url'         => 'nullable|url|max:500',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $validated['is_active']  = $request->boolean('is_active');
        $validated['sort_order'] = $request->input('sort_order', 0);

        if ($request->hasFile('image')) {
            if ($project->image) Storage::disk('public')->delete($project->image);
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        if ($project->image) Storage::disk('public')->delete($project->image);
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted.');
    }
}
