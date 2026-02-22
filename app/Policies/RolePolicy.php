<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('view_role');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('view_role');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('create_role');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('update_role');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('delete_role');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        return $user->isSuperAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        return $user->isSuperAdmin();
    }

    public function attach(User $user, Role $role): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('attach_role');
    }

    public function detach(User $user, Role $role): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('detach_role');
    }
}
