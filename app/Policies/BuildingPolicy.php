<?php

namespace App\Policies;

use App\Models\Building;
use App\Models\User;
use Filament\Facades\Filament;

class BuildingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isSuperAdmin() || ($user->canAccessTenant(Filament::getTenant()) && $user->hasPermission('view_building'));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Building $building): bool
    {
        return $user->isSuperAdmin() || ($user->canAccessTenant(Filament::getTenant()) && $user->hasPermission('view_building'));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isSuperAdmin() || ($user->canAccessTenant(Filament::getTenant()) && $user->hasPermission('create_building'));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Building $building): bool
    {
        return $user->isSuperAdmin() || ($user->canAccessTenant(Filament::getTenant()) && $user->hasPermission('update_building'));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Building $building): bool
    {
        return $user->isSuperAdmin() || ($user->canAccessTenant(Filament::getTenant()) && $user->hasPermission('delete_building'));
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Building $building): bool
    {
        return $user->isSuperAdmin() || ($user->canAccessTenant(Filament::getTenant()) && $user->hasPermission('restore_building'));
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Building $building): bool
    {
        return $user->isSuperAdmin() || ($user->canAccessTenant(Filament::getTenant()) && $user->hasPermission('force_delete_building'));
    }
}
