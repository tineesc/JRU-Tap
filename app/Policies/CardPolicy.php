<?php

namespace App\Policies;

use App\Models\Card;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CardPolicy
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
    public function view(User $user, Card $card)
    {
        return $user->hasRole(1);
       
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if($user->hasPermissionTo(22) || $user->hasRole(1)) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Card $card)
    {
        if($user->hasPermissionTo(23) || $user->hasRole(1) ) {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Card $card)
    {
        if($user->hasPermissionTo(24) || $user->hasRole(1)) {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Card $card)
    {
        return $user->hasRole(1);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Card $card)
    {
        return $user->hasRole(1);
    }
}
