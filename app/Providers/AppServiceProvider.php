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
            $tenant = Filament::getTenant();  // Get the current tenant (team)

            if ($tenant) {
                // Fetch the related company
                $company = $tenant->companies->first();  // Assuming one company per team

                if ($company) {
                    // Dynamically set the app name based on the company name
                    config(['app.name' => $company->company_name]);
                } else {
                    // Set a fallback name if no company is found
                    config(['app.name' => 'Default Company Name']);
                }
            }
        });
    }
}
