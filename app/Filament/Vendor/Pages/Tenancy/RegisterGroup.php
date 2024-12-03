<?php

namespace App\Filament\Vendor\Pages\Tenancy;

use App\Models\Group;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterGroup extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register Group';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Group Details')->schema([
                        TextInput::make('code')
                            ->label('Group Code')
                            ->maxLength(3)
                            ->required()
                            ->placeholder('E.g., 001'),

                        TextInput::make('description')
                            ->label('Description')
                            ->required(),

                        TextInput::make('prefix')
                            ->label('Prefix')
                            ->maxLength(3)
                            ->required()
                            ->placeholder('E.g., 444'),

                        TextInput::make('consecutive_length')
                            ->label('Consecutive Length')
                            ->numeric()
//                            ->min(5)
//                            ->max(10)
                            ->default(5)
                            ->required(),
                    ]),
                ]),
            ]);
    }

    protected function handleRegistration(array $data): Group
    {
        // Create the group
        $group = Group::create([
            'code' => $data['code'],
            'description' => $data['description'],
            'prefix' => $data['prefix'],
            'consecutive_length' => $data['consecutive_length'],
            'status' => true,
            'current_sequence' => 0,
        ]);

        // Attach the authenticated user to the group's members
        $group->members()->attach(auth()->user());

        return $group;
    }

}
