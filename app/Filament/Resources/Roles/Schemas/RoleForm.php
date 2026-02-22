<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->lazy()
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        if ($state) {
                            $set('code', str()->slug($state));
                        }
                    }),
                TextInput::make('code')
                    ->required(),
                // TextInput::make('tenant_id')
                //     ->required()
                //     ->numeric(),
            ]);
    }
}
