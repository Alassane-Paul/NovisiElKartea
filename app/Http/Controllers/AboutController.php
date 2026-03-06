<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMember;

class AboutController extends Controller
{
    public function index()
    {
        $whatPage = \App\Models\Page::where('slug', 'about-what')->first();
        $members = \App\Models\TeamMember::where('active', true)
            ->orderBy('order')
            ->get()
            ->groupBy('category');
        $partnersPage = \App\Models\Page::where('slug', 'about-partners')->first();
        $partners = \App\Models\Partner::where('active', true)->orderBy('order')->get();
        $featuredProjects = \App\Models\Project::active()->featured()->latest()->take(3)->get();

        return view('about.index', compact('whatPage', 'members', 'partnersPage', 'partners', 'featuredProjects'));
    }

    public function what()
    {
        $page = \App\Models\Page::where('slug', 'about-what')->firstOrFail();
        return view('about.what', compact('page'));
    }

    public function who()
    {
        $page = \App\Models\Page::where('slug', 'about-who')->first();
        $members = TeamMember::where('active', true)
            ->orderBy('order')
            ->get()
            ->groupBy('category');
        $categoryNames = TeamMember::CATEGORIES;

        return view('about.who', compact('members', 'categoryNames', 'page'));
    }

    public function partners()
    {
        $page = \App\Models\Page::where('slug', 'about-partners')->first();
        $partners = \App\Models\Partner::where('active', true)->orderBy('order')->get();
        return view('about.partners', compact('page', 'partners'));
    }
}
