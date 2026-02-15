<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $socials = [
            'facebook' => ['Facebook', 'https://facebook.com', 'fab fa-facebook-f'],
            'twitter' => ['Twitter / X', 'https://twitter.com', 'fab fa-x-twitter'],
            'instagram' => ['Instagram', 'https://instagram.com', 'fab fa-instagram'],
            'linkedin' => ['LinkedIn', 'https://linkedin.com', 'fab fa-linkedin-in'],
            'youtube' => ['YouTube', 'https://youtube.com', 'fab fa-youtube'],
            'tiktok' => ['TikTok', 'https://tiktok.com', 'fab fa-tiktok'],
            'pinterest' => ['Pinterest', 'https://pinterest.com', 'fab fa-pinterest'],
            'whatsapp' => ['WhatsApp', 'https://whatsapp.com', 'fab fa-whatsapp'],
            'telegram' => ['Telegram', 'https://telegram.org', 'fab fa-telegram'],
            'snapchat' => ['Snapchat', 'https://snapchat.com', 'fab fa-snapchat'],
        ];

        $order = 1;

        foreach ($socials as $key => $info) {
            // URL Setting
            Setting::firstOrCreate(
                ['key' => "social_{$key}_url"],
                [
                    'value' => $info[1],
                    'type' => 'url',
                    'group' => 'social',
                    'label' => "URL {$info[0]}",
                    'description' => "Lien vers le compte {$info[0]}",
                    'order' => $order++,
                ]
            );

            // Active Setting
            Setting::firstOrCreate(
                ['key' => "social_{$key}_active"],
                [
                    'value' => true, // Use actual boolean
                    'type' => 'boolean',
                    'group' => 'social',
                    'label' => "Afficher {$info[0]}",
                    'description' => "Activer/Désactiver l'icône {$info[0]}",
                    'order' => $order++,
                ]
            );
        }

        // Contact Settings
        Setting::firstOrCreate(['key' => 'contact_email'], [
            'value' => 'contact@novisielkartea.org',
            'type' => 'email',
            'group' => 'contact',
            'label' => 'Email de contact',
            'description' => 'Email affiché sur le site',
            'order' => 100,
        ]);
        
        Setting::firstOrCreate(['key' => 'contact_phone'], [
            'value' => '+34 000 000 000',
            'type' => 'text',
            'group' => 'contact',
            'label' => 'Téléphone',
            'description' => 'Numéro de téléphone principal',
            'order' => 101,
        ]);
        
         Setting::firstOrCreate(['key' => 'contact_address'], [
            'value' => 'Calle Principal 123, Vitoria-Gasteiz',
            'type' => 'text',
            'group' => 'contact',
            'label' => 'Adresse',
            'description' => 'Adresse postale complète',
            'order' => 102,
        ]);

        // Site Settings
        Setting::firstOrCreate(['key' => 'site_logo'], [
            'value' => null,
            'type' => 'file',
            'group' => 'site',
            'label' => 'Logo du site',
            'description' => 'Logo affiché dans le header (PNG, JPG, SVG)',
            'order' => 200,
        ]);

        Setting::firstOrCreate(['key' => 'site_name'], [
            'value' => 'Novisi Elkartea',
            'type' => 'text',
            'group' => 'site',
            'label' => 'Nom du site',
            'description' => 'Nom affiché dans le titre',
            'order' => 201,
        ]);
    }
}
