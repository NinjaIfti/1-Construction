<?php

namespace App\Policies;

use App\Models\Permit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PermitPolicy
{
    use HandlesAuthorization;

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
    public function view(User $user, Permit $permit): bool
    {
        return $user->isAdmin() || $user->id === $permit->project->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permit $permit): bool
    {
        return $user->isAdmin() || $user->id === $permit->project->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permit $permit): bool
    {
        return $user->isAdmin() || $user->id === $permit->project->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Permit $permit): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Permit $permit): bool
    {
        return $user->isAdmin();
    }
} 