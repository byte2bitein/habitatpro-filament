<?php

namespace App\Filament\Resources\Units\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UnitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')
                    ->searchable(),
                TextColumn::make('floor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('unitType.name')
                    ->searchable(),
                TextColumn::make('building.name')
                    ->searchable(),
                TextColumn::make('maintenance_rate')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->since()
                    ->tooltip(fn ($record) => $record->created_at->format('F d, Y H:i'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->since()
                    ->tooltip(fn ($record) => $record->updated_at->format('F d, Y H:i'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->defaultGroup('building.name')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
