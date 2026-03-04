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
        
        // Si c'est déjà un tableau, on l'utilise
        if (is_array($translations)) {
            // OK
        }
        // Si c'est une chaîne JSON, décode
        elseif (is_string($translations)) {
            $decoded = json_decode($translations, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $translations = $decoded;
            } else {
                // Pas du JSON, c'est probablement une valeur brute (fallback)
                return $translations;
            }
        } else {
            return $field;
        }
        
        // Fallback: es -> fr -> en -> eu -> valeur brute
        return $translations[$locale] 
            ?? $translations['es'] 
            ?? $translations['fr'] 
            ?? $translations['en'] 
            ?? $translations['eu'] 
            ?? ($this->getOriginal($field) ?: $field);
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