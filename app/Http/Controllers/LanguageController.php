<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch the application language
     */
    public function switch(Request $request, $locale)
    {
        // Check if the locale is supported
        $availableLocales = config('app.available_locales', [
            'en' => 'English',
            'bn' => 'বাংলা'
        ]);

        if (!is_array($availableLocales) || !array_key_exists($locale, $availableLocales)) {
            abort(404);
        }

        // Set the application locale
        App::setLocale($locale);

        // Store the locale in session
        Session::put('locale', $locale);

        // If user is authenticated, we could also store it in database
        if (auth()->check()) {
            // You can add a locale column to users table and update it here
            // auth()->user()->update(['locale' => $locale]);
        }

        return redirect()->back()->with('success', __('ui.language_changed'));
    }

    /**
     * Get current locale
     */
    public function current()
    {
        return response()->json([
            'current_locale' => App::getLocale(),
            'available_locales' => config('app.available_locales', [
                'en' => 'English',
                'bn' => 'বাংলা'
            ])
        ]);
    }
}
