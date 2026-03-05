<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactSubmission;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        $validated['type'] = 'contact';

        $submission = ContactSubmission::create($validated);

        // Envoyer un email à l'administrateur
        $adminEmail = config('mail.from.address'); // Ou toute autre adresse configurée
        if ($adminEmail) {
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\ContactFormSubmitted($submission));
        }

        return redirect()->route('contact.index')->with('success', __('contact.success_message') ?? 'Message sent successfully!');
    }
}
