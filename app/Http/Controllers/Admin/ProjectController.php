<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title.es' => 'required|string|max:255',
            'title.fr' => 'nullable|string|max:255',
            'title.eu' => 'nullable|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'slug' => 'required|string|in:afrikarte,diversidad,igualdad,new-generation|unique:projects,slug|max:255',
            'category' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'description.*' => 'nullable|string',
            'content.*' => 'nullable|string',
            'featured' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $validated['image'] = $path;
        }

        // Auto-generate translated titles/content if empty? 
        // For now, we trust the input or the model's auto-translate trait if enabled.

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Projet créé avec succès.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title.es' => 'required|string|max:255',
            'title.fr' => 'nullable|string|max:255',
            'title.eu' => 'nullable|string|max:255',
            'title.en' => 'nullable|string|max:255',
            'slug' => 'required|string|in:afrikarte,diversidad,igualdad,new-generation|unique:projects,slug,' . $project->id . '|max:255',
            'category' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:active,inactive',
            'description.*' => 'nullable|string',
            'content.*' => 'nullable|string',
            'featured' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $path = $request->file('image')->store('projects', 'public');
            $validated['image'] = $path;
        }

        $validated['featured'] = $request->has('featured');

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Projet mis à jour avec succès.');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Projet supprimé avec succès.');
    }
}
