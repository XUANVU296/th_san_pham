<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_Group extends Model
{
    use HasFactory;
    protected $table = 'role_group';

    protected $fillable = [
        'role_id',
        'group_id',
    ];
}
