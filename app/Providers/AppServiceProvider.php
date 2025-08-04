<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Services\TranslationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TranslationService::class, function ($app) {
            return new TranslationService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Add custom Blade directive for auto-translation
        Blade::directive('translate', function ($expression) {
            return "<?php echo app(App\Services\TranslationService::class)->translateToBangla($expression); ?>";
        });

        // Add helper for conditional translation
        Blade::directive('autoTranslate', function ($expression) {
            return "<?php echo app()->getLocale() === 'bn' ? app(App\Services\TranslationService::class)->translateToBangla($expression) : $expression; ?>";
        });
    }
}
