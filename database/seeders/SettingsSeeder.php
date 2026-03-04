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
        Setting::updateOrCreate(['key' => 'contact_email'], [
            'value' => 'novisielkartea@outlook.es',
            'type' => 'email',
            'group' => 'contact',
            'label' => 'Email de contact',
            'description' => 'Email affiché sur le site',
            'order' => 100,
        ]);

        Setting::updateOrCreate(['key' => 'contact_phone'], [
            'value' => '0034 946 75 68 68 / 631245242',
            'type' => 'text',
            'group' => 'contact',
            'label' => 'Téléphone',
            'description' => 'Numéro de téléphone principal',
            'order' => 101,
        ]);

        Setting::updateOrCreate(['key' => 'contact_address'], [
            'value' => 'C/SAGARMINAGA 7, PLANTA BAJA',
            'type' => 'text',
            'group' => 'contact',
            'label' => 'Adresse (Rue)',
            'description' => 'Rue et numéro',
            'order' => 102,
        ]);

        Setting::updateOrCreate(['key' => 'contact_municipality'], [
            'value' => 'Bilbao',
            'type' => 'text',
            'group' => 'contact',
            'label' => 'Municipalité',
            'description' => 'Ville ou commune',
            'order' => 103,
        ]);

        Setting::updateOrCreate(['key' => 'contact_zip'], [
            'value' => '48004',
            'type' => 'text',
            'group' => 'contact',
            'label' => 'Code Postal',
            'description' => 'C.P.',
            'order' => 104,
        ]);

        Setting::updateOrCreate(['key' => 'contact_territory'], [
            'value' => 'Bizkaia',
            'type' => 'text',
            'group' => 'contact',
            'label' => 'Territoire',
            'description' => 'Province ou territoire',
            'order' => 105,
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
