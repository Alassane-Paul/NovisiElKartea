<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class InterfaceTranslation extends Model
{
    use HasTranslations;
    
    protected $fillable = [
        'group',
        'key',
        'text',
        'notes',
    ];

    protected $casts = [
        'text' => 'array',
    ];

    public $autoTranslate = false; // On traduit manuellement ici
    
    public function getTranslatableFields(): array
    {
        return ['text'];
    }

    /**
     * Get translation for current locale
     */
    public function getTranslatedText(): string
    {
        return $this->getTranslated('text');
    }

    /**
     * Static helper pour faciliter l'utilisation
     */
    public static function trans(string $group, string $key, ?string $locale = null): string
    {
        static $cache = [];
        
        $locale = $locale ?? app()->getLocale();
        $cacheKey = "{$group}.{$key}.{$locale}";
        
        if (isset($cache[$cacheKey])) {
            return $cache[$cacheKey];
        }
        
        $translation = self::where('group', $group)
            ->where('key', $key)
            ->first();
        
        if (!$translation) {
            // Fallback aux fichiers de langue
            $value = trans("{$group}.{$key}");
            $cache[$cacheKey] = $value;
            return $value;
        }
        
        $value = $translation->getTranslated('text', $locale);
        $cache[$cacheKey] = $value;
        
        return $value;
    }

    /**
     * Update or create translation
     */
    public static function updateOrCreateTranslation(string $group, string $key, array $translations, ?string $notes = null): self
    {
        return self::updateOrCreate(
            ['group' => $group, 'key' => $key],
            ['text' => $translations, 'notes' => $notes]
        );
    }
}