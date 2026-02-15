<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::latest('order')->paginate(10);
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image',
            'name.es' => 'required',
            'email' => 'nullable|email',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        TeamMember::create($data);

        return redirect()->route('admin.team.index')->with('success', 'Membre créé avec succès.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $request->validate([
            'photo' => 'nullable|image',
            'name.es' => 'required',
            'email' => 'nullable|email',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        if ($request->hasFile('photo')) {
            if ($team->photo) {
                Storage::disk('public')->delete($team->photo);
            }
            $data['photo'] = $request->file('photo')->store('team', 'public');
        }

        $team->update($data);

        return redirect()->route('admin.team.index')->with('success', 'Membre mis à jour avec succès.');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo) {
            Storage::disk('public')->delete($team->photo);
        }
        
        $team->delete();

        return redirect()->route('admin.team.index')->with('success', 'Membre supprimé avec succès.');
    }
}
