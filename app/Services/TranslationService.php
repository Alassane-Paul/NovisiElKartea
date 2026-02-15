<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationService
{
    protected $translator;
    
    public function __construct()
    {
        $this->translator = new GoogleTranslate();
    }
    
    public function translateText(string $text, string $target): string
    {
        try {
            return GoogleTranslate::trans($text, $target, 'es');
        } catch (\Exception $e) {
            return $text; // Fallback: retourne l'original
        }
    }

    public function translateToAll(string $text): array
    {
        $translations = ['es' => $text];
        $locales = ['fr', 'eu', 'en'];

        foreach ($locales as $locale) {
            $translations[$locale] = $this->translateText($text, $locale);
        }

        return $translations;
    }
}