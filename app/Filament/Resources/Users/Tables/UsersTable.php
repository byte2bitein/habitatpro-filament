<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->visible(fn () => auth()->user()->isSuperAdmin()),
                TextColumn::make('two_factor_confirmed_at')
                    ->dateTime()
                    ->sortable()
                    ->visible(fn () => auth()->user()->isSuperAdmin()),
                TextColumn::make('phone_number')
                    ->prefix('+91 ')
                    ->copyable(),
                IconColumn::make('is_super_admin')
                    ->boolean()
                    ->visible(fn () => auth()->user()->isSuperAdmin()),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn ($record) => auth()->user()->isSuperAdmin() || auth()->user()->can('update', $record)),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(fn ($record) => auth()->user()->isSuperAdmin() || auth()->user()->can('delete', $record)),
                ]),
            ]);
    }
}
