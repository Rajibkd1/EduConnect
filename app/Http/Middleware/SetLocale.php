<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get available locales
        $availableLocales = array_keys(config('app.available_locales', ['en' => 'English', 'bn' => 'বাংলা']));

        // Determine locale from various sources
        $locale = $this->determineLocale($request, $availableLocales);

        // Set the application locale
        App::setLocale($locale);

        // Store in session for persistence
        Session::put('locale', $locale);

        return $next($request);
    }

    /**
     * Determine the locale from various sources
     */
    private function determineLocale(Request $request, array $availableLocales): string
    {
        // 1. Check if locale is in session (user's previous choice)
        if (Session::has('locale') && in_array(Session::get('locale'), $availableLocales)) {
            return Session::get('locale');
        }

        // 2. Check if user is authenticated and has a preferred locale
        if (auth()->check() && auth()->user()->locale && in_array(auth()->user()->locale, $availableLocales)) {
            return auth()->user()->locale;
        }

        // 3. Check browser's preferred language
        $browserLocale = $request->getPreferredLanguage($availableLocales);
        if ($browserLocale && in_array($browserLocale, $availableLocales)) {
            return $browserLocale;
        }

        // 4. Fall back to default locale
        return config('app.locale', 'en');
    }
}
