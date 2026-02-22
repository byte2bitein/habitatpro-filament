<?php

namespace App\Filament\Resources\Buildings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BuildingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('code')
                    ->required(),
                // TextInput::make('tenant_id')
                //     ->required()
                //     ->numeric(),
                TextInput::make('floors')
                    ->required()
                    ->numeric(),
            ]);
    }
}
