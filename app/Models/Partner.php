<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasTranslations;

class Partner extends Model
{
    use HasTranslations;

    public function getTranslatableFields(): array
    {
        return ['name', 'description'];
    }

    protected $fillable = [
        'name',
        'description',
        'logo',
        'website',
        'type',
        'order',
        'active',
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'active' => 'boolean',
        'order' => 'integer',
    ];

    const TYPES = [
        'institutional' => 'Institucional',
        'educational' => 'Educativo',
        'social' => 'Social',
        'business' => 'Empresarial',
    ];
}