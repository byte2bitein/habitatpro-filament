<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Settings;
use App\Filament\Pages\Tenancy\EditTenantProfile;
use App\Filament\Pages\Tenancy\RegisterTenant;
use App\Http\Middleware\VerifyIsAdmin;
use App\Models\Tenant;
use Filament\Actions\Action;
use Filament\Auth\MultiFactor\App\AppAuthentication;
use Filament\Auth\MultiFactor\Email\EmailAuthentication;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile()
            ->multiFactorAuthentication([
                AppAuthentication::make()
                    ->recoverable()
                    ->regenerableRecoveryCodes(false)
                    ->codeWindow(2)
                    ->brandName(config('app.name')),
                EmailAuthentication::make()
                    ->codeExpiryMinutes(1),
            ], isRequired: config('filament.auth.mfa.is_required', false))
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
                // Settings::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                // FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                VerifyIsAdmin::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label(label: 'Dashboard')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url('/')
                    ->visible(fn () => auth()->user()->isSuperAdmin()),
            ])
            ->tenant(Tenant::class, slugAttribute: 'slug')
            ->tenantRegistration(RegisterTenant::class)
            ->tenantProfile(EditTenantProfile::class)
            ->tenantMenuItems([
                'register' => fn (Action $action) => $action->visible(fn (?Tenant $tenant) => auth()->user()->isSuperAdmin()),
                'profile' => fn (Action $action) => $action->visible(fn (?Tenant $tenant) => auth()->user()->isSuperAdmin())
                    ->label('Edit society information'),
            ])
            ->searchableTenantMenu()
            ->collapsibleNavigationGroups()
            ->sidebarCollapsibleOnDesktop(true)
            ->databaseNotifications();
    }
}
