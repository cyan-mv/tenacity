<?php

namespace App\Filament\App\Pages\Tenancy;

use App\Models\Company;
use App\Models\Team;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterTeam extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register Team';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Company')->schema([
                        TextInput::make('company_name')
                            ->label('Company Name')
                            ->required(),
//                        TextInput::make('status')
//                            ->label('Status')
//                            ->default(1), // Assuming 1 is the active status
                    ]),
                    Step::make('Team')->schema([
                        TextInput::make('team_name')
                            ->label('Team Name')
                            ->required(),
                    ])
                ]),
            ]);
    }

    protected function handleRegistration(array $data): Team
    {
        // First, create the company
        $company = Company::create([
            'company_name' => $data['company_name'],
            'status' => $data['status'] ?? 1, // Use the default status if not provided
            'email' => $data['email'] ?? 'test@example.com', // Temporary email for testing
            'legal_name' => $data['legal_name'] ?? 'Default Legal Name',
            'tax_id' => $data['tax_id'] ?? '123456789',
            'phone' => $data['phone'] ?? '123-456-7890',
            'address' => $data['address'] ?? 'Default Address',
            'website' => $data['website'] ?? 'https://example.com',
            'city' => $data['city'] ?? 'Default City',
            'state' => $data['state'] ?? 'Default State',
            'country' => $data['country'] ?? 'Default Country',
        ]);

        // Then, create the team associated with the company
        $team = Team::create([
            'name' => $data['team_name'],
            'company_id' => $company->id,
        ]);

        // Attach the authenticated user to the team
        $team->members()->attach(auth()->user());

        return $team;
    }
}
