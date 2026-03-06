<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasTranslations;

class Service extends Model
{
    use HasTranslations;

    public function getTranslatableFields(): array
    {
        return ['title', 'description', 'content', 'meta_title', 'meta_description'];
    }

    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'content',
        'icon',
        'image',
        'order',
        'active',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'content' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
        'active' => 'boolean',
        'order' => 'integer',
    ];

    // Services correspondant à ton PDF
    const CATEGORIES = [
        'education' => 'Educación y formación',
        'intercultural' => 'Interculturalidad y convivencia',
        'culture' => 'Cultura y patrimonio',
        'participation' => 'Participación social y asociacionismo',
        'equality' => 'Igualdad y Derechos Humanos',
        'cooperation' => 'Cooperación al Desarrollo',
    ];

    public function getCategoryLabel(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category ?? 'Sans catégorie';
    }

    public function getCurrentTitleAttribute()
    {
        return $this->title[app()->getLocale()] ?? $this->title['es'] ?? '';
    }

    public function getCurrentDescriptionAttribute()
    {
        return $this->description[app()->getLocale()] ?? $this->description['es'] ?? '';
    }

    public function getCurrentContentAttribute()
    {
        return $this->content[app()->getLocale()] ?? $this->content['es'] ?? '';
    }
}
