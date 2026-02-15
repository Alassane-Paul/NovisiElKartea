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

    public function afrikarte()
    {
        return view('projects.afrikarte');
    }

    public function diversity()
    {
        return view('projects.diversity');
    }

    public function equality()
    {
        return view('projects.equality');
    }

    public function newGeneration()
    {
        return view('projects.new-generation');
    }
}
