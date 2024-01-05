<?php

namespace App\Policies;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GroupPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('groups.index');
    }
    public function create(User $user): bool
    {
        return $user->hasPermission('groups.create');
    }
    public function update(User $user): bool
    {
        return $user->hasPermission('groups.edit');
    }
    public function delete(User $user): bool
    {
        return $user->hasPermission('groups.destroy');
    }
    public function updatePermissions(User $user, Group $group)
    {
        return $user->group_id === 0;
    }
}
