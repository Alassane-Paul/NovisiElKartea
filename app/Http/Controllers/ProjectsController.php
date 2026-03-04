<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = \App\Models\Project::where('status', 'active')->orderBy('featured', 'desc')->get();
        return view('projects.index', compact('projects'));
    }

    public function show($slug)
    {
        $project = \App\Models\Project::where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return view('projects.show', compact('project'));
    }
}
