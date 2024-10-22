<?php

namespace App\Filament\App\Widgets;

use App\Models\Team;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Collection;

class VendorSummary extends Widget
{
    protected static string $view = 'filament.app.widgets.vendor-summary';
//    protected static string $view = 'filament.widgets.text-widget';

    public ?User $authenticatedUser;
    public ?string $tenant_id;

    public ?Team $tenant;
    public ?string $tenant_name;

    public ?Collection $tenant_clients;

    public function mount()
    {
        // Get the authenticated user
        $this->authenticatedUser = auth()->user();

        if ($this->authenticatedUser) {
            // Retrieve the current tenant (team)
            $this->tenant = Filament::getTenant();
            $this->tenant_name = $this->tenant?->name;
            $this->tenant_id = $this->tenant?->id;
//            $this->tenant_clients = $this->tenant->clients()->get();

            // Get the actual collection of clients related to the tenant (team)
            $this->tenant_clients = $this->tenant->clients()->get();


        }
    }

}
