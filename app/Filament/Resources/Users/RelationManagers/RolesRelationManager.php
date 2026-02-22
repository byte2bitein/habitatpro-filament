<?php

namespace App\Filament\Resources\Users\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RolesRelationManager extends RelationManager
{
    protected static string $relationship = 'roles';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                // TextInput::make('code')
                //     ->required(),
                // TextInput::make('tenant_id')
                //     ->required()
                //     ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                // TextColumn::make('code')
                //     ->searchable(),
                // TextColumn::make('tenant_id')
                //     ->numeric()
                //     ->sortable(),
                // TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // CreateAction::make(),
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->visible(function (RelationManager $livewire) {
                        return auth()->user()->isSuperAdmin() || auth()->user()->can('attach', $livewire->getOwnerRecord());
                    })->after(function () {
                        // TODO
                    }),
            ])
            ->recordActions([
                // EditAction::make(),
                DetachAction::make()
                    ->visible(function (RelationManager $livewire) {
                        return auth()->user()->isSuperAdmin() || auth()->user()->can('detach', $livewire->getOwnerRecord());
                    }),
                // DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make()
                        ->visible(function (RelationManager $livewire) {
                            return auth()->user()->isSuperAdmin() || auth()->user()->can('detach', $livewire->getOwnerRecord());
                        }),
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
