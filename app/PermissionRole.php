<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    protected $primaryKey = 'permission_role_id';
    protected $table = 'permission_role';
    protected $guarded = [];
}
