<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $services = \App\Models\Service::where('active', true)->orderBy('order')->get();
        return view('services.index', compact('services'));
    }

    public function education()
    {
        $services = \App\Models\Service::where('active', true)->where('category', 'education')->orderBy('order')->get();
        return view('services.index', compact('services'));
    }

    public function intercultural()
    {
        $services = \App\Models\Service::where('active', true)->where('category', 'intercultural')->orderBy('order')->get();
        return view('services.index', compact('services'));
    }

    public function culture()
    {
        $services = \App\Models\Service::where('active', true)->where('category', 'culture')->orderBy('order')->get();
        return view('services.index', compact('services'));
    }

    public function participation()
    {
        $services = \App\Models\Service::where('active', true)->where('category', 'participation')->orderBy('order')->get();
        return view('services.index', compact('services'));
    }

    public function equality()
    {
        $services = \App\Models\Service::where('active', true)->where('category', 'equality')->orderBy('order')->get();
        return view('services.index', compact('services'));
    }

    public function cooperation()
    {
        $services = \App\Models\Service::where('active', true)->where('category', 'cooperation')->orderBy('order')->get();
        return view('services.index', compact('services'));
    }

    public function show($slug)
    {
        $service = \App\Models\Service::where('slug', $slug)->where('active', true)->firstOrFail();
        return view('services.show', compact('service'));
    }
}
