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
        $projects = Project::ordered()->get();
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
            'image'       => 'required|image|mimes:webp,png,jpg|max:5120',
            'url'         => 'nullable|url',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        $validated['image'] = $request->file('image')->store('projects', 'public');
        $validated['is_active'] = $request->has('is_active');
        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created!');
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
            'image'       => 'nullable|image|mimes:webp,png,jpg|max:5120',
            'url'         => 'nullable|url',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image) Storage::disk('public')->delete($project->image);
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project updated!');
    }

    public function destroy(Project $project)
    {
        if ($project->image) Storage::disk('public')->delete($project->image);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted!');
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            Project::where('id', $id)->update(['sort_order' => $index]);
        }
        return response()->json(['success' => true]);
    }
}
