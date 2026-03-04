<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $contactSettings = [
            'contact_email' => [
                'value' => 'novisielkartea@outlook.es',
                'type' => 'email',
                'label' => 'Email de contact',
                'order' => 100,
            ],
            'contact_phone' => [
                'value' => '0034 946 75 68 68 / 631245242',
                'type' => 'text',
                'label' => 'Téléphone',
                'order' => 101,
            ],
            'contact_address' => [
                'value' => 'C/SAGARMINAGA 7, PLANTA BAJA',
                'type' => 'text',
                'label' => 'Adresse (Rue)',
                'order' => 102,
            ],
            'contact_municipality' => [
                'value' => 'Bilbao',
                'type' => 'text',
                'label' => 'Municipalité',
                'order' => 103,
            ],
            'contact_zip' => [
                'value' => '48004',
                'type' => 'text',
                'label' => 'Code Postal',
                'order' => 104,
            ],
            'contact_territory' => [
                'value' => 'Bizkaia',
                'type' => 'text',
                'label' => 'Territoire',
                'order' => 105,
            ],
        ];

        foreach ($contactSettings as $key => $data) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $data['value'],
                    'type' => $data['type'],
                    'group' => 'contact',
                    'label' => $data['label'],
                    'order' => $data['order'],
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't necessarily want to delete settings on rollback, 
        // but we could at least remove the newly added keys if we wanted to be strict.
        // For now, doing nothing is safer to avoid data loss.
    }
};
