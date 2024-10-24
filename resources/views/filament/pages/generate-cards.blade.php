<x-filament::page>
    <form wire:submit.prevent="generate">
        {{ $this->form }}

        <div class="mt-8">
            <x-filament::button type="submit">
                Generate Cards
            </x-filament::button>
        </div>
    </form>
</x-filament::page>
