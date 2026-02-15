<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;

class GenerateTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translations:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Génère les traductions automatiquement depuis l'espagnol";

    /**
     * Execute the console command.
     */
   public function handle()
    {
        $translator = new GoogleTranslate();
        
        // Traduire chaque fichier
        foreach (['header', 'buttons', 'footer'] as $filename) {
            $this->translateFile($filename, $translator);
        }
        
        $this->info('✅ Traductions générées avec succès !');
    }
    
    protected function translateFile($filename, $translator)
    {
        $esFile = resource_path("lang/es/{$filename}.php");
        
        // Méthode CORRECTE pour lire le fichier PHP
        $esContent = include $esFile;
        
        // Vérifie que c'est bien un tableau
        if (!is_array($esContent)) {
            $this->error("❌ Le fichier {$filename}.php ne retourne pas un tableau valide");
            return;
        }
        
        $this->info("📄 Traduction du fichier: {$filename}.php");
        
        foreach (['fr', 'eu', 'en'] as $locale) {
            $this->info("  → Traduction en {$locale}...");
            
            $translatedContent = [];
            
            foreach ($esContent as $key => $text) {
                try {
                    $translated = $translator->setSource('es')
                                            ->setTarget($locale)
                                            ->translate($text);
                    $translatedContent[$key] = $translated;
                    
                    // Affiche une traduction sur 10 pour le suivi
                    if (rand(1, 10) === 1) {
                        $this->line("    {$text} → {$translated}");
                    }
                    
                    // Pause pour éviter rate limiting
                    usleep(800000); // 0.8 seconde
                    
                } catch (\Exception $e) {
                    $translatedContent[$key] = $text; // Garde l'espagnol en cas d'erreur
                    $this->error("    ❌ Erreur pour '{$text}': " . $e->getMessage());
                    
                    // Plus longue pause après une erreur
                    sleep(2);
                }
            }
            
            // Sauvegarde le fichier
            $this->saveTranslationFile($filename, $locale, $translatedContent);
            $this->info("    ✅ Fichier {$locale}/{$filename}.php créé");
        }
    }
    
    protected function saveTranslationFile($filename, $locale, $content)
    {
        $filePath = resource_path("lang/{$locale}/{$filename}.php");
        
        // Formate le contenu PHP correctement
        $phpContent = "<?php\n\nreturn [\n";
        
        foreach ($content as $key => $value) {
            // Échappe les apostrophes et guillemets
            $safeValue = addslashes($value);
            $phpContent .= "    '{$key}' => '{$safeValue}',\n";
        }
        
        $phpContent .= "];\n";
        
        file_put_contents($filePath, $phpContent);
    }
}
