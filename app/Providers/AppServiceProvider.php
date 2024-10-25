<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use App\Models\Team;

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
        view()->composer('*', function ($view) {
            // Get the current tenant (team) using Filament
            $tenant = Filament::getTenant();

            if ($tenant) {
                // Fetch the related company for the team using the correct relationship
                $company = optional($tenant->company);  // Use the correct 'belongsTo' relationship

                if ($company->exists) {
                    // Dynamically set the app name based on the company name
                    config(['app.name' => $company->company_name]);
                } else {
                    // Set a fallback name if no company is found
                    config(['app.name' => 'Default Company Name']);
                }
            } else {
                // Fallback if there is no tenant
                config(['app.name' => 'Laravel']);
            }
        });
    }
}
