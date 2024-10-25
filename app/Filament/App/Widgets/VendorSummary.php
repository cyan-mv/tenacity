<?php

namespace App\Filament\App\Widgets;

use Filament\Facades\Filament;
use Filament\Widgets\Widget;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;



class VendorSummary extends Widget
{
    protected static string $view = 'filament.app.widgets.vendor-summary';
    public ?Team $tenant;
    public ?string $tenant_name;
    public ?string $company_name; // Add company name property
    public $authenticatedUser;
    public ?collection $tenant_clients;

    public function mount()
    {
        // Get the authenticated user
        $this->authenticatedUser = auth()->user();

        if ($this->authenticatedUser) {
            // Retrieve the current tenant (team)
            $this->tenant = Filament::getTenant();
            $this->tenant_name = $this->tenant->name;
            $this->tenant_clients = $this->tenant->clients()->get();

            // Fetch the company related to the tenant
            $this->company_name = optional($this->tenant->company)->company_name;
        }
    }

}
