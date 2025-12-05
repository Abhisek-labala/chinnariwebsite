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
            view()->share('contactSettings', $contactSettings);
        } catch (\Exception $e) {
            // Do nothing if DB is not ready
        }
    }
}
