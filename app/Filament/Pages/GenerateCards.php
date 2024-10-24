<?php

namespace App\Filament\Pages;

use App\Models\Group;
use App\Services\CardGenerator;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;

class GenerateCards extends Page
{
    // Properties to hold form data
    public $group_id;
    public $quantity;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $title = 'Generate Cards';
    protected static string $view = 'filament.pages.generate-cards';

    protected static ?string $navigationLabel = 'Generate Cards';
    protected static ?string $navigationGroup = 'Card Management';

    // Method to generate cards
    public function generate()
    {
        $data = $this->form->getState();

        // Find the group
        $group = Group::find($data['group_id']);

        if ($group) {
            // Call the card generator to generate cards
            CardGenerator::generateCards($group, $data['quantity']);
//            $this->notify('success', $data['quantity'] . ' cards generated successfully for ' . $group->description);
        } else {
            print('mmmmm');
            $this->notify('danger', 'Group not found.');
        }
    }

    // Initialize the form schema
    protected function getFormSchema(): array
    {
        return [
            Select::make('group_id')
                ->label('Select Group')
                ->options(Group::all()->pluck('description', 'id')) // Load group options
                ->required(),
            TextInput::make('quantity')
                ->label('Number of Cards')
                ->numeric()
                ->minValue(1)
                ->required(),
        ];
    }

    // Define the submit action
    public function submit()
    {
        $this->generate();
    }
}
