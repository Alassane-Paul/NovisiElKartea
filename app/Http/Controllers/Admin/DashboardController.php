<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => \App\Models\Project::count(),
            'services' => \App\Models\Service::count(),
            'team' => \App\Models\TeamMember::count(),
            'partners' => \App\Models\Partner::count(),
        ];

        $recentProjects = \App\Models\Project::latest()->take(5)->get();
        $recentServices = \App\Models\Service::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects', 'recentServices'));
    }
}
