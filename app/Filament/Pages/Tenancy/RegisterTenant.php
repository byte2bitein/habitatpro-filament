<?php

namespace App\Filament\Pages\Tenancy;

use App\Events\TenantCreated;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant as BaseRegisterTenant;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class RegisterTenant extends BaseRegisterTenant
{
    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    public static function getLabel(): string
    {
        return 'Register Tenant';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Add your tenant registration form fields here
                TextInput::make("name")
                    ->label("Tenant Name")
                    ->required()
                    ->lazy()
                    ->unique(ignoreRecord: true)
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $set("slug", \Str::slug($state));
                    }),
                TextInput::make("slug")
                    ->required(),
            ]);
    }

    public function handleRegistration(array $data): \Illuminate\Database\Eloquent\Model
    {
        // Handle tenant registration logic here
        // For example, you can create a new Team and associate it with the user

        $model = config('filament.tenancy.default_tenant_model');

        $tenant = $model::create([
            'name' => $data['name'],
            'slug' => \Str::slug($data['name']),
        ]);

        // Optionally, associate the tenant with the currently authenticated user
        $tenant->users()->attach(auth()->id());

        TenantCreated::dispatch($tenant);

        return $tenant;
    }
}
