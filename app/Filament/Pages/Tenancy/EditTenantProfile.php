<?php

namespace App\Filament\Pages\Tenancy;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\EditTenantProfile as TenancyEditTenantProfile;
use Filament\Schemas\Schema;

class EditTenantProfile extends TenancyEditTenantProfile
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function getLabel(): string
    {
        return 'Edit Tenant Profile';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Society Name')
                    ->required(),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required(),
                Textarea::make('address')
                    ->label('Address')
                    ->required(),
                FileUpload::make('logo')
                    ->label('Logo')
                    ->directory('logos')
                    ->visibility('public')
                    ->image(),
                TextInput::make('longitude')
                    ->label('Longitude')
                    ->required(false),
                TextInput::make('latitude')
                    ->label('Latitude')
                    ->required(false),
                TextInput::make('contact_name')
                    ->label('Contact Name')
                    ->required(false),
                TextInput::make('contact_email')
                    ->label('Contact Email')
                    ->required(false),
                TextInput::make('contact_phone')
                    ->label('Contact Phone')
                    ->required(false),
            ])
            ->columns(2);
    }
}
