<?php

namespace App\Policies;

use App\Models\Places;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PlacePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->hasRole([1,2]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Places $places)
    {
        return $user->hasRole([1]);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->hasRole([1]);
        if($user->hasPermissionTo(13)) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Places $places)
    {
        return $user->hasRole([1]);
        if($user->hasPermissionTo(14)) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Places $places)
    {
        return $user->hasRole([1]);
        if($user->hasPermissionTo(15)) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Places $places)
    {
        return $user->hasRole([1]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Places $places)
    {
        return $user->hasRole([1]);
    }
}
