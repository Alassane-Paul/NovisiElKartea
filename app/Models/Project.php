<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasTranslations;

class Project extends Model
{
    use HasTranslations;

    public function getTranslatableFields(): array
    {
        return ['title', 'description', 'content', 'meta_title', 'meta_description'];
    }

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'images',
        'category',
        'status',
        'start_date',
        'end_date',
        'location',
        'featured',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'content' => 'array',
        'images' => 'array',
        'meta_title' => 'array',
        'meta_description' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'featured' => 'boolean',
    ];

    // Accessors pour la langue courante
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

    // Scopes utiles
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}