<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Facades\Filament;
use App\Models\User;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;


class TextWidget extends Widget
{
    protected static string $view = 'filament.widgets.text-widget';

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
