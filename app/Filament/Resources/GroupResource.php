<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
use App\Models\Group;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\ColorPicker;

class GroupResource extends Resource
{
    protected static ?string $model = Group::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->numeric()
                    ->length(3) // Exact length of 3
                    ->required(),
                Textarea::make('description')
                    ->required(),
                TextInput::make('prefix')
                    ->numeric()
                    ->length(3) // Exact length of 3
                    ->required(),
                TextInput::make('consecutive_length')
                    ->numeric()
                    ->minValue(5) // Between 5 and 10
                    ->maxValue(10)
                    ->required(),
                ColorPicker::make('color')
                    ->label('Color')
                    ->placeholder('#FF5733 or blue') // Example placeholder
                    ->required(),
                FileUpload::make('image')
                    ->label('Image')
                    ->image() // Indicates it's for image uploads
                    ->required(),
                Select::make('status')
                    ->options([
                        true => 'Active',
                        false => 'Inactive',
                    ])
                    ->required(),
                Select::make('teams')
                    ->multiple() // Allow multiple selections
                    ->relationship('teams', 'name') // Use the teams relationship
                    ->required()
                    ->label('Brands'),
            ]);
    }

    // After record creation, attach the selected teams
    public static function afterCreate($record, array $data): void
    {
        // Sync the selected teams with the group
        if (isset($data['teams'])) {
            $record->teams()->sync($data['teams']);
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('prefix')
                    ->label('Prefix')
                    ->sortable(),
                TextColumn::make('consecutive_length')
                    ->label('Consecutive Length')
                    ->sortable(),
                TextColumn::make('color')
                    ->label('Color'),
                ImageColumn::make('image')
                    ->label('Image'),
                TextColumn::make('teams.name')
                    ->label('Brands')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($record) {
                        // Fetch the team names associated with the group
                        return $record->teams->pluck('name')->implode(', ');
                    }),
                BooleanColumn::make('status')
                    ->label('Status'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
        ];
    }
}
