<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
//use App\Filament\Resources\BranchResource\RelationManagers;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

//    protected static ?string $navigationGroup = 'Companies management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('branch_name')->required(),
                TextInput::make('branch_phone')->required(),
                TextInput::make('branch_address')->required(),
                TextInput::make('branch_city')->required(),
                TextInput::make('branch_country')->required(),
                TextInput::make('branch_state')->required(),
                Select::make('team_id')
                    ->relationship('team', 'name')  // Assuming 'name' is a field in your Team model
                    ->required(),
//                Select::make('brand_id')
//                    ->relationship('brand', 'name')  // Assuming 'name' is a field in your Brand model
//                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('branch_name'),
                TextColumn::make('branch_phone'),
                TextColumn::make('branch_address'),
                TextColumn::make('branch_city'),
                TextColumn::make('branch_country'),
                TextColumn::make('team.name'),  // Show related team
//                TextColumn::make('brand.name'),  // Show related brand
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
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
