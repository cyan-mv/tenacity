<?php

namespace App\Providers;

use Filament\Facades\Filament;
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
        // Assuming you're using Filament::getTenant() to get the current tenant
        view()->composer('*', function ($view) {
            $tenant = Filament::getTenant();

            if ($tenant) {
                // Dynamically set the app name based on the tenant name
                config(['app.name' => $tenant->name]);
            }
        });
    }
}
