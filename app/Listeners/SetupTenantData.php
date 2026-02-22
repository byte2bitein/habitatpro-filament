<?php

namespace App\Listeners;

use App\Events\TenantCreated;
use App\Models\User;
use Database\Seeders\FilamentDataSeeder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetupTenantData
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TenantCreated $event): void
    {
        if ($event->tenant) {
            FilamentDataSeeder::SeedTenantDefaultRolesAndPermissions($event->tenant);
            $super_admin_user = User::where('is_super_admin', true)->first();
            $event->tenant->users()->attach($super_admin_user);
        }
    }
}
