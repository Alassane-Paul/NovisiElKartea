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
        return view('services.education');
    }

    public function intercultural()
    {
        return view('services.intercultural');
    }
}
