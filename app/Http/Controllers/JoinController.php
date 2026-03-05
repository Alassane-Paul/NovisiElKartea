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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'nullable|string',
        ]);

        $validated['type'] = 'join';

        $submission = \App\Models\ContactSubmission::create($validated);

        // Envoyer un email à l'administrateur
        $adminEmail = config('mail.from.address');
        if ($adminEmail) {
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\ContactFormSubmitted($submission));
        }

        return redirect()->route('join.index')->with('success', __('join.success_message') ?? 'Form submitted successfully!');
    }
}
