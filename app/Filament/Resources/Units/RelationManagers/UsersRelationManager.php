<?php

namespace App\Filament\Resources\Units\RelationManagers;

use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                // TextInput::make('password')
                //     ->password()
                //     ->required(),
                // TextInput::make('tenant_id')
                //     ->numeric()
                //     ->default(null),
                // Toggle::make('is_super_admin')
                //     ->required(),
                // Textarea::make('app_authentication_secret')
                //     ->default(null)
                //     ->columnSpanFull(),
                // Textarea::make('app_authentication_recovery_codes')
                //     ->default(null)
                //     ->columnSpanFull(),
                // Textarea::make('has_email_authentication')
                //     ->default(null)
                //     ->columnSpanFull(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('email')
                    ->label('Email address'),
                // TextEntry::make('email_verified_at')
                //     ->dateTime()
                //     ->placeholder('-'),
                // TextEntry::make('tenant_id')
                //     ->numeric()
                //     ->placeholder('-'),
                // IconEntry::make('is_super_admin')
                //     ->boolean(),
                // TextEntry::make('app_authentication_secret')
                //     ->placeholder('-')
                //     ->columnSpanFull(),
                // TextEntry::make('app_authentication_recovery_codes')
                //     ->placeholder('-')
                //     ->columnSpanFull(),
                // TextEntry::make('has_email_authentication')
                //     ->placeholder('-')
                //     ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('email')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->searchable(),
                TextColumn::make('from_date')
                    ->since()
                    ->dateTooltip(fn (TextColumn $column) => $column->getRecord()->from_date)
                    ->label('From Date'),
                TextColumn::make('to_date')
                    ->since()
                    ->dateTooltip(fn (TextColumn $column) => $column->getRecord()->to_date)
                    ->label('To Date'),
                // TextColumn::make('email_verified_at')
                //     ->dateTime()
                //     ->sortable(),
                // TextColumn::make('tenant_id')
                //     ->numeric()
                //     ->sortable(),
                // IconColumn::make('is_super_admin')
                //     ->boolean(),
                TextColumn::make('created_at')
                    ->since()
                    ->tooltip(fn (TextColumn $column) => $column->getRecord()->created_at)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->since()
                    ->tooltip(fn (TextColumn $column) => $column->getRecord()->updated_at)
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // CreateAction::make(),
                AttachAction::make()
                    ->preloadRecordSelect()
                    ->schema(fn (AttachAction $action) => [
                        $action->getRecordSelect(),
                        DatePicker::make('from_date')
                            ->required(),
                        Select::make('role')
                            ->options([
                                'owner' => 'Owner',
                                'tenant' => 'Tenant',
                            ])
                            ->required(),
                        DatePicker::make('to_date'),
                    ]),
            ])
            ->recordActions([
                // ViewAction::make()
                //     ->schema(fn (ViewAction $action) => [
                //         TextEntry::make('name'),
                //         TextEntry::make('email'),
                //         TextEntry::make('role'),
                //         TextEntry::make('from_date'),
                //         TextEntry::make('to_date'),
                //     ]),
                EditAction::make()
                    ->schema(fn (EditAction $action) => [
                        TextInput::make('name')->readOnly(),
                        DatePicker::make('from_date')->readOnly(),
                        Select::make('role')->options([
                            'owner' => 'Owner',
                            'tenant' => 'Tenant',
                        ]),
                        DatePicker::make('to_date'),
                    ]),
                // DetachAction::make(),
                // DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DetachBulkAction::make(),
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
