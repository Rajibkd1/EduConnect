<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TranslationService;

class TranslateContent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'translate:content {--force : Force retranslation of existing content}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically translate missing content to Bangla';

    protected $translationService;

    public function __construct(TranslationService $translationService)
    {
        parent::__construct();
        $this->translationService = $translationService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting automatic translation process...');

        try {
            // Translate missing language keys
            $this->info('Translating missing language keys...');
            $this->translationService->autoTranslateMissingKeys('bn');

            // Translate subjects from database
            $this->info('Translating subjects from database...');
            $this->translationService->translateSubjects();

            // Translate any hardcoded text in views
            $this->info('Scanning views for hardcoded text...');
            $this->translateViewContent();

            $this->info('Translation process completed successfully!');

        } catch (\Exception $e) {
            $this->error('Translation failed: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Scan and translate hardcoded text in views
     */
    private function translateViewContent()
    {
        $viewFiles = glob(resource_path('views/**/*.blade.php'));
        $hardcodedTexts = [];

        foreach ($viewFiles as $file) {
            $content = file_get_contents($file);
            
            // Find hardcoded English text patterns
            preg_match_all('/(?:>|\s)([A-Z][a-zA-Z\s]{3,50})(?:<|\s|$)/', $content, $matches);
            
            foreach ($matches[1] as $text) {
                $text = trim($text);
                if ($this->isTranslatableText($text)) {
                    $hardcodedTexts[] = $text;
                }
            }
        }

        if (!empty($hardcodedTexts)) {
            $this->info('Found ' . count($hardcodedTexts) . ' hardcoded texts to translate');
            
            // Create a hardcoded translations file
            $translations = [];
            foreach (array_unique($hardcodedTexts) as $text) {
                $translations[strtolower(str_replace(' ', '_', $text))] = $this->translationService->translateToBangla($text);
            }

            $this->saveHardcodedTranslations($translations);
        }
    }

    /**
     * Check if text is translatable
     */
    private function isTranslatableText(string $text): bool
    {
        // Skip if it's likely a variable name, class name, or technical term
        if (preg_match('/^[A-Z][a-z]+[A-Z]/', $text)) return false; // CamelCase
        if (preg_match('/[0-9]/', $text)) return false; // Contains numbers
        if (strlen($text) < 4) return false; // Too short
        if (in_array(strtolower($text), ['html', 'css', 'javascript', 'php', 'laravel'])) return false;
        
        return true;
    }

    /**
     * Save hardcoded translations
     */
    private function saveHardcodedTranslations(array $translations)
    {
        $filePath = resource_path('lang/bn/hardcoded.php');
        $content = "<?php\n\nreturn " . var_export($translations, true) . ";\n";
        
        file_put_contents($filePath, $content);
        $this->info('Saved hardcoded translations to: ' . $filePath);
    }
}
