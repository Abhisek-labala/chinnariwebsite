<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            $contactSettings = \App\Models\Setting::whereIn('key', ['contact_address', 'contact_phone', 'contact_email', 'contact_timings_morning', 'contact_timings_evening', 'contact_map_url'])->pluck('value', 'key');
            $themeSettings = \App\Models\Setting::whereIn('key', ['site_name', 'site_logo', 'theme_primary', 'theme_secondary', 'theme_accent', 'site_name_color', 'show_site_name', 'site_logo_height'])->pluck('value', 'key');
            
            view()->share('contactSettings', $contactSettings);
            view()->share('themeSettings', $themeSettings);
        } catch (\Exception $e) {
            // Do nothing if DB is not ready
        }
    }
}
