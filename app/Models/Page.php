<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasTranslations;

class Page extends Model
{
    use HasTranslations;

    public function getTranslatableFields(): array
    {
        return ['title', 'content', 'meta_title', 'meta_description'];
    }

    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'template',
        'featured_image',
        'active',
        'parent_id',
    ];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
        'active' => 'boolean',
    ];

    // Pages correspondant à ton PDF
    const PAGES = [
        'about-what' => '¿Qué es Novisi Elkartea?',
        'about-who' => '¿Quiénes somos?',
        'about-partners' => 'Alianzas',
        'asociate' => 'Asóciate',
    ];

    public function getCurrentTitleAttribute()
    {
        return $this->title[app()->getLocale()] ?? $this->title['es'] ?? '';
    }

    public function getCurrentContentAttribute()
    {
        return $this->content[app()->getLocale()] ?? $this->content['es'] ?? '';
    }
}
