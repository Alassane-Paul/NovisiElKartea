<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTranslations;

class Setting extends Model
{
    use HasTranslations;
    
    protected $fillable = [
        'key',
        'value',
        'boolean_value',
        'type',
        'group',
        'label',
        'description',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
        'boolean_value' => 'boolean',
    ];

    public $autoTranslate = false; 
    
    public function getTranslatableFields(): array
    {
        // Only translate value if it's text. URL, Email, Boolean should not be translated.
        return $this->type === 'text' ? ['value'] : [];
    }

    /**
     * Get the value attribute with proper type handling
     */
    public function getValueAttribute($value)
    {
        // For boolean type, use boolean_value column instead
        if ($this->type === 'boolean') {
            return $this->boolean_value;
        }
        
        // For text type, check if it's JSON or plain text
        if ($this->type === 'text') {
            // Try to decode as JSON
            $decoded = json_decode($value, true);
            // Only return decoded if it's actually JSON (array)
            if (is_array($decoded)) {
                return $decoded;
            }
            // Otherwise return as-is (plain text)
            return $value;
        }
        
        // For JSON type specifically, always decode
        if ($this->type === 'json') {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }
        
        // For other types (url, email, file), return as-is
        return $value;
    }

    /**
     * Helper to get a setting value
     */
    public static function getValue(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        
        if (!$setting) {
            return $default;
        }
        
        if ($setting->type === 'text') {
            return $setting->getTranslated('value');
        }

        // For boolean, return from boolean_value column
        if ($setting->type === 'boolean') {
            return $setting->boolean_value ?? false;
        }
        
        return $setting->value;
    }

    /**
     * Helper to set a setting value
     */
    public static function setValue(string $key, $value, string $type = 'text', array $options = []): void
    {
        $setting = self::firstOrCreate(
            ['key' => $key],
            [
                'type' => $type,
                'group' => $options['group'] ?? 'general',
                'label' => $options['label'] ?? $key,
                'description' => $options['description'] ?? null,
                'order' => $options['order'] ?? 0,
            ]
        );
        
        $setting->value = $value;
        $setting->save();
    }
}