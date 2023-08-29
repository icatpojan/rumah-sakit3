<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $primaryKey = 'permission_id';
    protected $table = 'permission';
    protected $guarded = [];

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    // }
}
