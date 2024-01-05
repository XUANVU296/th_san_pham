<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('users.index');
    }
    public function create(User $user): bool
    {
        return $user->hasPermission('users.create');
    }
    public function update(User $user): bool
    {
        return $user->hasPermission('users.edit');
    }
    public function delete(User $user): bool
    {
        return $user->hasPermission('users.destroy');
    }
}
