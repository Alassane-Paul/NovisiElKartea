<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasTranslations;

class TeamMember extends Model
{
    use HasTranslations;

    public function getTranslatableFields(): array
    {
        return ['name', 'position', 'bio', 'mandate'];
    }

    protected $fillable = [
        'name',
        'position',
        'bio',
        'photo',
        'email',
        'phone',
        'order',
        'category',
        'mandate',
        'active',
        'social_links',
    ];

    const CATEGORIES = [
        'board' => 'Junta Directiva',
        'technical' => 'Equipo Técnico',
    ];

    protected $casts = [
        'name' => 'array',
        'position' => 'array',
        'bio' => 'array',
        'mandate' => 'array',
        'social_links' => 'array',
        'active' => 'boolean',
        'order' => 'integer',
    ];

    public function getCurrentNameAttribute()
    {
        return $this->name[app()->getLocale()] ?? $this->name['es'] ?? '';
    }

    public function getCurrentPositionAttribute()
    {
        return $this->position[app()->getLocale()] ?? $this->position['es'] ?? '';
    }
}