<?php

namespace App\Filament\Resources\Units\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number')
                    ->required(),
                TextInput::make('floor')
                    ->required()
                    ->numeric(),
                Select::make('building_id')
                    ->label('Building')
                    ->required()
                    ->options(\App\Models\Building::all()->pluck('name', 'id'))
                    ->searchable(),
                Select::make('unit_type_id')
                    ->label('Unit Type')
                    ->required()
                    ->options(\App\Models\UnitType::all()->pluck('name', 'id'))
                    ->searchable(),
                TextInput::make('maintenance_rate')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                // TextInput::make('tenant_id')
                //     ->required()
                //     ->numeric(),
            ]);
    }
}
