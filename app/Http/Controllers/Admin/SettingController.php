<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // Group settings by their 'order' column
        $settings = Setting::orderBy('order')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Validate file uploads
        $request->validate([
            'site_logo' => 'nullable|image|max:2048', // 2MB max
        ]);

        // Get all settings to know which boolean checkboxes might be missing from request
        $allSettings = Setting::all();

        foreach ($allSettings as $setting) {
            $key = $setting->key;

            if ($setting->type === 'boolean') {
                // Checkboxes are not sent if unchecked, so we default to false
                $setting->boolean_value = $request->has($key);
                $setting->save();
            } elseif ($setting->type === 'file') {
                // Handle file uploads
                if ($request->hasFile($key)) {
                    // Delete old file if exists
                    if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                        Storage::disk('public')->delete($setting->value);
                    }
                    
                    // Store new file
                    $path = $request->file($key)->store('settings', 'public');
                    $setting->value = $path;
                    $setting->save();
                }
            } else {
                if ($request->has($key)) {
                    $setting->value = $request->input($key);
                    $setting->save();
                }
            }
        }

        return redirect()->route('admin.settings.index')->with('success', 'Paramètres mis à jour avec succès.');
    }
}
