<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterfaceTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TranslationController extends Controller
{
    public function index(Request $request)
    {
        $query = InterfaceTranslation::query();

        if ($request->filled('search')) {
            $query->where('key', 'like', '%' . $request->search . '%')
                  ->orWhere('text', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('group')) {
            $query->where('group', $request->group);
        }

        $translations = $query->orderBy('group')->orderBy('key')->paginate(20);
        $groups = InterfaceTranslation::select('group')->distinct()->pluck('group');

        return view('admin.translations.index', compact('translations', 'groups'));
    }

    public function create()
    {
        return view('admin.translations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'group' => 'required|string',
            'key' => 'required|string|unique:interface_translations,key,NULL,id,group,' . $request->group,
            'text.es' => 'required|string',
        ]);

        InterfaceTranslation::create($request->all());

        return redirect()->route('admin.translations.index')->with('success', 'Traduction créée avec succès.');
    }

    public function edit(InterfaceTranslation $translation)
    {
        return view('admin.translations.edit', compact('translation'));
    }

    public function update(Request $request, InterfaceTranslation $translation)
    {
        $request->validate([
            'text.es' => 'required|string',
        ]);

        $translation->update($request->all());

        return redirect()->route('admin.translations.index')->with('success', 'Traduction mise à jour avec succès.');
    }

    public function destroy(InterfaceTranslation $translation)
    {
        $translation->delete();
        return redirect()->route('admin.translations.index')->with('success', 'Traduction supprimée avec succès.');
    }

    /**
     * Import translations from PHP language files
     */
    public function import()
    {
        $groups = ['header', 'footer', 'auth', 'pagination', 'passwords', 'validation'];
        $locales = ['es', 'fr', 'eu', 'en'];

        foreach ($groups as $group) {
            foreach ($locales as $locale) {
                $path = lang_path("$locale/$group.php");
                
                if (File::exists($path)) {
                    $lines = include $path;
                    
                    if (is_array($lines)) {
                        foreach ($lines as $key => $value) {
                            if (is_string($value)) {
                                $translation = InterfaceTranslation::firstOrNew([
                                    'group' => $group,
                                    'key' => $key
                                ]);

                                $currentText = $translation->text ?? [];
                                $currentText[$locale] = $value;
                                $translation->text = $currentText;
                                $translation->save();
                            }
                        }
                    }
                }
            }
        }

        return redirect()->route('admin.translations.index')->with('success', 'Traductions importées depuis les fichiers.');
    }
}
