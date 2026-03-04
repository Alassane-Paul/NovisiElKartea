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
        // If no settings exist, initialize defaults
        if (Setting::count() === 0) {
            $this->initializeDefaultSettings();
        }

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

    private function initializeDefaultSettings(): void
    {
        $defaults = [
            // Site
            ['key' => 'site_name', 'value' => 'Novisi Elkartea', 'type' => 'text', 'group' => 'site', 'label' => 'Nom du site', 'description' => 'Nom affiché dans le titre', 'order' => 1],
            ['key' => 'site_logo', 'value' => null, 'type' => 'file', 'group' => 'site', 'label' => 'Logo du site', 'description' => 'Logo affiché dans le header', 'order' => 2],

            // SEO
            ['key' => 'seo_description', 'value' => 'Novisi Elkartea - Cooperación, Cultura e Interculturalidad', 'type' => 'text', 'group' => 'seo', 'label' => 'Description SEO', 'description' => 'Description par défaut pour les moteurs de recherche', 'order' => 10],
            ['key' => 'seo_keywords', 'value' => 'cooperación, cultura, interculturalidad, vitoria-gasteiz', 'type' => 'text', 'group' => 'seo', 'label' => 'Mots-clés SEO', 'description' => 'Mots-clés séparés par des virgules', 'order' => 11],

            // Contact
            ['key' => 'contact_email', 'value' => 'novisielkartea@outlook.es', 'type' => 'email', 'group' => 'contact', 'label' => 'Email de contact', 'description' => 'Email affiché sur le site', 'order' => 20],
            ['key' => 'contact_phone', 'value' => '0034 946 75 68 68 / 631245242', 'type' => 'text', 'group' => 'contact', 'label' => 'Téléphone', 'description' => 'Numéro de téléphone principal', 'order' => 21],
            ['key' => 'contact_address', 'value' => 'C/SAGARMINAGA 7, PLANTA BAJA', 'type' => 'text', 'group' => 'contact', 'label' => 'Adresse (Rue)', 'description' => 'Rue et numéro', 'order' => 22],
            ['key' => 'contact_municipality', 'value' => 'Bilbao', 'type' => 'text', 'group' => 'contact', 'label' => 'Municipalité', 'description' => 'Ville ou commune', 'order' => 23],
            ['key' => 'contact_zip', 'value' => '48004', 'type' => 'text', 'group' => 'contact', 'label' => 'Code Postal', 'description' => 'C.P.', 'order' => 24],
            ['key' => 'contact_territory', 'value' => 'Bizkaia', 'type' => 'text', 'group' => 'contact', 'label' => 'Territoire', 'description' => 'Province ou département', 'order' => 25],
        ];

        // Socials
        $socials = ['facebook', 'twitter', 'instagram', 'linkedin', 'youtube', 'tiktok', 'pinterest', 'whatsapp', 'telegram', 'snapchat'];
        $order = 30;
        foreach ($socials as $social) {
            $defaults[] = ['key' => "social_{$social}_url", 'value' => 'https://' . ($social === 'twitter' ? 'x.com' : $social . '.com'), 'type' => 'url', 'group' => 'social', 'label' => "URL " . ucfirst($social), 'description' => "Lien vers le compte " . ucfirst($social), 'order' => $order++];
            $defaults[] = ['key' => "social_{$social}_active", 'boolean_value' => true, 'type' => 'boolean', 'group' => 'social', 'label' => "Afficher " . ucfirst($social), 'description' => "Activer/Désactiver l'icône", 'order' => $order++];
        }

        foreach ($defaults as $data) {
            Setting::create($data);
        }
    }
}
