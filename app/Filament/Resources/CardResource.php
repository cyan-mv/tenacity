<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CardResource\Pages;
use App\Models\Card;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CardResource extends Resource
{
    protected static ?string $model = Card::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Card Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('card_number')
                    ->label('Card Number')
                    ->required(),
                Select::make('group_id')
                    ->relationship('group', 'description') // Assumes group has a 'description' field
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('card_number')
                    ->label('Card Number')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('group.description')
                    ->label('Group'),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
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
            'index' => Pages\ListCards::route('/'),
            'create' => Pages\CreateCard::route('/create'),
            'edit' => Pages\EditCard::route('/{record}/edit'),
        ];
    }
}
