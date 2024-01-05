<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';

    protected $fillable = [
        'name',
    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_group', 'group_id', 'role_id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'group_id', 'id');
    }
    public function hasPermission($permission)
    {
        $permissions = $this->users()->get();
        return $permissions->contains('permission_name', $permission);
    }
}
