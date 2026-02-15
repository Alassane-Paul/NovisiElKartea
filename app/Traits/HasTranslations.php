<?php

namespace App\Traits;

use App\Services\TranslationService;

trait HasTranslations
{
    /**
     * Boot the trait
     */
    protected static function bootHasTranslations()
    {
        static::saving(function ($model) {
            if (method_exists($model, 'shouldAutoTranslate') && $model->shouldAutoTranslate()) {
                $translator = app(TranslationService::class);
                
                foreach ($model->getTranslatableFields() as $field) {
                    $current = $model->getAttribute($field);
                    
                    // Si c'est un tableau avec espagnol rempli mais autres langues vides
                    if (is_array($current) && !empty($current['es'])) {
                        $hasOtherLanguages = isset($current['fr']) || isset($current['eu']) || isset($current['en']);
                        
                        // Ne traduire que si nouveau ou espagnol modifié
                        $original = $model->getOriginal($field);
                        $isNewOrModified = empty($original) || ($original['es'] ?? '') !== $current['es'];
                        
                        if (!$hasOtherLanguages && $isNewOrModified) {
                            $translations = $translator->translateToAll($current['es']);
                            $model->setAttribute($field, $translations);
                        }
                    }
                }
            }
        });
    }

    /**
     * Get translated value for current locale
     */
    public function getTranslated(string $field, ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $translations = $this->{$field};
        
        // Si c'est une chaîne JSON, décode
        if (is_string($translations)) {
            $translations = json_decode($translations, true) ?? [];
        }
        
        // Fallback: es -> fr -> en -> eu -> clé
        return $translations[$locale] 
            ?? $translations['es'] 
            ?? $translations['fr'] 
            ?? $translations['en'] 
            ?? $translations['eu'] 
            ?? $field;
    }

    /**
     * Set translation for specific locale
     */
    public function setTranslation(string $field, string $locale, string $value): void
    {
        $translations = $this->{$field} ?? [];
        
        if (is_string($translations)) {
            $translations = json_decode($translations, true) ?? [];
        }
        
        $translations[$locale] = $value;
        $this->{$field} = $translations;
    }

    /**
     * Get all translations for a field
     */
    public function getTranslations(string $field): array
    {
        $translations = $this->{$field} ?? [];
        
        if (is_string($translations)) {
            $translations = json_decode($translations, true) ?? [];
        }
        
        return $translations;
    }

    /**
     * Check if model should auto-translate
     * Override this in your model if needed
     */
    public function shouldAutoTranslate(): bool
    {
        return property_exists($this, 'autoTranslate') 
            ? $this->autoTranslate 
            : true;
    }

    /**
     * Get list of translatable fields
     * Must be implemented in each model
     */
    abstract public function getTranslatableFields(): array;
}