<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    private $apiKey;
    private $cachePrefix = 'translation_';
    private $cacheDuration = 86400; // 24 hours

    public function __construct()
    {
        $this->apiKey = config('services.google_translate.key');
    }

    /**
     * Translate text from English to Bangla
     */
    public function translateToBangla(string $text): string
    {
        if (empty($text)) {
            return $text;
        }

        // Check cache first
        $cacheKey = $this->cachePrefix . md5($text . '_en_bn');
        $cached = Cache::get($cacheKey);

        if ($cached) {
            return $cached;
        }

        try {
            // Try Google Translate API first
            $translation = $this->translateWithGoogleAPI($text, 'en', 'bn');

            if ($translation) {
                Cache::put($cacheKey, $translation, $this->cacheDuration);
                return $translation;
            }

            // Fallback to LibreTranslate (free alternative)
            $translation = $this->translateWithLibreTranslate($text, 'en', 'bn');

            if ($translation) {
                Cache::put($cacheKey, $translation, $this->cacheDuration);
                return $translation;
            }

            // If all fails, return original text
            return $text;
        } catch (\Exception $e) {
            Log::error('Translation failed: ' . $e->getMessage());
            return $text;
        }
    }

    /**
     * Translate using Google Translate API
     */
    private function translateWithGoogleAPI(string $text, string $from, string $to): ?string
    {
        if (!$this->apiKey) {
            return null;
        }

        try {
            $response = Http::get('https://translation.googleapis.com/language/translate/v2', [
                'key' => $this->apiKey,
                'q' => $text,
                'source' => $from,
                'target' => $to,
                'format' => 'text'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['data']['translations'][0]['translatedText'] ?? null;
            }
        } catch (\Exception $e) {
            Log::error('Google Translate API error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Translate using LibreTranslate (free alternative)
     */
    private function translateWithLibreTranslate(string $text, string $from, string $to): ?string
    {
        try {
            $response = Http::post('https://libretranslate.de/translate', [
                'q' => $text,
                'source' => $from,
                'target' => $to,
                'format' => 'text'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['translatedText'] ?? null;
            }
        } catch (\Exception $e) {
            Log::error('LibreTranslate API error: ' . $e->getMessage());
        }

        return null;
    }

    /**
     * Translate an array of texts
     */
    public function translateArray(array $texts): array
    {
        $translations = [];

        foreach ($texts as $key => $text) {
            if (is_array($text)) {
                $translations[$key] = $this->translateArray($text);
            } else {
                $translations[$key] = $this->translateToBangla($text);
            }
        }

        return $translations;
    }

    /**
     * Auto-translate missing language keys
     */
    public function autoTranslateMissingKeys(string $locale = 'bn'): void
    {
        if ($locale !== 'bn') {
            return;
        }

        $englishFiles = glob(resource_path('lang/en/*.php'));

        foreach ($englishFiles as $englishFile) {
            $filename = basename($englishFile);
            $banglaFile = resource_path("lang/bn/{$filename}");

            $englishTranslations = include $englishFile;
            $banglaTranslations = file_exists($banglaFile) ? include $banglaFile : [];

            $missingKeys = $this->findMissingKeys($englishTranslations, $banglaTranslations);

            if (!empty($missingKeys)) {
                $newTranslations = $this->translateMissingKeys($missingKeys);
                $banglaTranslations = array_merge_recursive($banglaTranslations, $newTranslations);

                $this->saveTranslationFile($banglaFile, $banglaTranslations);
            }
        }
    }

    /**
     * Find missing translation keys
     */
    private function findMissingKeys(array $english, array $bangla, string $prefix = ''): array
    {
        $missing = [];

        foreach ($english as $key => $value) {
            $fullKey = $prefix ? "{$prefix}.{$key}" : $key;

            if (is_array($value)) {
                $banglaValue = $bangla[$key] ?? [];
                $missing = array_merge($missing, $this->findMissingKeys($value, $banglaValue, $fullKey));
            } else {
                if (!isset($bangla[$key]) || empty($bangla[$key])) {
                    $missing[$fullKey] = $value;
                }
            }
        }

        return $missing;
    }

    /**
     * Translate missing keys
     */
    private function translateMissingKeys(array $missingKeys): array
    {
        $translations = [];

        foreach ($missingKeys as $key => $text) {
            $translatedText = $this->translateToBangla($text);
            $this->setNestedValue($translations, $key, $translatedText);
        }

        return $translations;
    }

    /**
     * Set nested array value using dot notation
     */
    private function setNestedValue(array &$array, string $key, $value): void
    {
        $keys = explode('.', $key);
        $current = &$array;

        foreach ($keys as $k) {
            if (!isset($current[$k]) || !is_array($current[$k])) {
                $current[$k] = [];
            }
            $current = &$current[$k];
        }

        $current = $value;
    }

    /**
     * Save translation file
     */
    private function saveTranslationFile(string $filepath, array $translations): void
    {
        $content = "<?php\n\nreturn " . var_export($translations, true) . ";\n";

        // Ensure directory exists
        $directory = dirname($filepath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        file_put_contents($filepath, $content);
    }

    /**
     * Batch translate subjects from database
     */
    public function translateSubjects(): void
    {
        $subjects = \App\Models\Subject::all();

        foreach ($subjects as $subject) {
            // Check if Bangla translation exists in subjects.php
            $banglaSubjects = include resource_path('lang/bn/subjects.php');

            if (!isset($banglaSubjects[$subject->name])) {
                $translatedName = $this->translateToBangla($subject->name);
                $translatedDescription = $this->translateToBangla($subject->description ?? '');

                $banglaSubjects[$subject->name] = [
                    'name' => $translatedName,
                    'description' => $translatedDescription
                ];

                $this->saveTranslationFile(
                    resource_path('lang/bn/subjects.php'),
                    $banglaSubjects
                );
            }
        }
    }
}
