<?php

namespace App\Policies;

use App\Models\Place;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class PlacePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Place $place): bool
    {
        return $user->id == $place->owner_id  || $user->hasRole('SuperAdmin');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // user is manager or admin user and can create places
        if ($user->hasRole('Manager') || $user->hasRole('SuperAdmin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Place $place): bool
    {
        //Log
        Log::info('User: ' . $user->name . ' is trying to update place with id: ' . $place->id);
        // user is owner of place or manager or admin user and can update places
        if ($user->id == $place->owner_id   || $user->hasRole('SuperAdmin')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Place $place): bool
    {
        // user is owner of place or manager or admin user and can delete places
        if ($user->id == $place->owner_id || $user->hasRole('SuperAdmin')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Place $place): bool
    {
        // user is owner of place or manager or admin user and can restore places
        if ($user->id == $place->owner_id || $user->hasRole('SuperAdmin')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Place $place): bool
    {
        // user is owner of place or admin user and can permanently delete places
        if ($user->id == $place->owner_id || $user->hasRole('SuperAdmin')) {
            return true;
        }

        return false;
    }
}
