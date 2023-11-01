<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasRole([1,2]);
        // if($user->hasPermissionTo('Create Post')) {
        //     return true;
        // }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role)
    {
        return $user->hasRole(1);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if($user->hasPermissionTo(4) || $user->hasRole(1)) {
            return true;
        }
        
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role)
    {
        if($user->hasPermissionTo(5) || $user->hasRole(1)) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role)
    {
        if($user->hasPermissionTo(6) || $user->hasRole(1)) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role)
    {
        return $user->hasRole(1);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role)
    {
        return $user->hasRole(1);
    }
}
