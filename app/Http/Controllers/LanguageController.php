<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch the application language
     *
     * @param Request $request
     * @param string $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function switch(Request $request, $locale)
    {
        // Check if the locale is supported
        $availableLocales = config('app.available_locales');
        
        if (!array_key_exists($locale, $availableLocales)) {
            return redirect()->back()->with('error', 'Language not supported');
        }

        // Set the application locale
        App::setLocale($locale);
        
        // Store the locale in session
        Session::put('locale', $locale);
        
        // If user is authenticated, we could also store it in database
        if (Auth::check()) {
            // You can add a locale column to users table and update it here
            // Auth::user()->update(['locale' => $locale]);
        }

        return redirect()->back()->with('success', __('ui.language_switched'));
    }

    /**
     * Get current locale
     *
     * @return string
     */
    public function getCurrentLocale()
    {
        return App::getLocale();
    }

    /**
     * Get available locales
     *
     * @return array
     */
    public function getAvailableLocales()
    {
        return config('app.available_locales');
    }
}
