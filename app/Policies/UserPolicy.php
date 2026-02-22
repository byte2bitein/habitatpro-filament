<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('view_user');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('view_user');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('create_user');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('update_user');
    }

    /**
     * Determine whether the user can attach the role to the model.
     */
    public function attach(User $user, User $model): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('attach_role');
    }

    /**
     * Determine whether the user can detach the role to the model.
     */
    public function detach(User $user, User $model): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('detach_role');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('delete_user');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('restore_user');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('force_delete_user');
    }
}
