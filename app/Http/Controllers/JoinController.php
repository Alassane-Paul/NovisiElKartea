<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JoinController extends Controller
{
    public function index()
    {
        $page = \App\Models\Page::where('slug', 'asociate')->first();
        return view('join.index', compact('page'));
    }

    public function store(Request $request)
    {
        // TODO: Implement join logic
        return redirect()->route('join.index')->with('success', 'Form submitted successfully!');
    }
}
