<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
use App\Models\Group;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

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
                    ->length(3)  // Exact length of 3
                    ->required(),
                Textarea::make('description')
                    ->required(),
                TextInput::make('prefix')
                    ->numeric()
                    ->length(3)  // Exact length of 3
                    ->required(),
                TextInput::make('consecutive_length')
                    ->numeric()
                    ->minValue(5)  // Between 5 and 10
                    ->maxValue(10)
                    ->required(),
                Select::make('status')
                    ->options([
                        true => 'Active',
                        false => 'Inactive',
                    ])
                    ->required(),
                Select::make('company_id')
                    ->relationship('company', 'company_name')
                    ->required(),
            ]);
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
                TextColumn::make('company.company_name')
                    ->label('Company')
                    ->sortable()
                    ->searchable(),
                BooleanColumn::make('status')  // Use BooleanColumn for boolean fields
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
