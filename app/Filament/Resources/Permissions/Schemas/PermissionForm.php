<?php

namespace App\Filament\Resources\Permissions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class PermissionForm
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
                            $set('code', str()->slug($state, '_'));
                        }
                    }),
                TextInput::make('code')
                    ->required(),
            ]);
    }
}
