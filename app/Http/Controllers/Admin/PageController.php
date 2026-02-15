<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest('updated_at')->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:pages,slug',
            'title.es' => 'required',
            'featured_image' => 'nullable|image',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('pages', 'public');
        }

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page créée avec succès.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'slug' => 'required|unique:pages,slug,' . $page->id,
            'title.es' => 'required',
            'featured_image' => 'nullable|image',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active');

        if ($request->hasFile('featured_image')) {
            if ($page->featured_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($page->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('pages', 'public');
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page mise à jour avec succès.');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page supprimée avec succès.');
    }
}
