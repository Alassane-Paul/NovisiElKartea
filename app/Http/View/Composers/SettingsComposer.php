<?php

namespace App\Http\View\Composers;

use App\Models\Setting;
use Illuminate\View\View;

class SettingsComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        // Get all settings and key them by their 'key'
        $allSettings = Setting::all();
        
        $settings = [];
        foreach ($allSettings as $setting) {
            $value = null;
            if ($setting->type === 'text') {
                $value = $setting->getTranslated('value');
            } elseif ($setting->type === 'boolean') {
                $value = $setting->boolean_value ?? false;
            } else {
                $value = $setting->value;
            }
            $settings[$setting->key] = $value;
        }

        $view->with('settings', $settings);
    }
}
