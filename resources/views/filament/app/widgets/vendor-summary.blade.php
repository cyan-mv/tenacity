<x-filament-widgets::widget>
    <x-filament::section>
        @if ($authenticatedUser)
            <p>Email: {{ $authenticatedUser->email }}</p>
            <p> Tenant ID: {{ $tenant->id }}</p>
            <p> Tenant name: {{ $tenant->name }} </p>
            <p> Tenant clients:
                {{ $tenant->clients->pluck('name')->implode(',') }}
            </p>
            <p> Company name: {{ $company_name }} </p> <!-- Display company name -->
        @else
            <p>No authenticated user found.</p>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
