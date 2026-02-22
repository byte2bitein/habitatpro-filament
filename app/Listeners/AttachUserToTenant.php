<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Filament\Facades\Filament;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AttachUserToTenant
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
    public function handle(UserCreated $event): void
    {
        if ($event->user) {
            $tenant = Filament::getTenant();
            info("Attaching user " . $event->user->name . " to tenant " . $tenant->name);
            $tenant->users()->attach($event->user);
        }
    }
}
