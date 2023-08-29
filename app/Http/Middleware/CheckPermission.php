<?php

namespace App\Http\Middleware;

use App\Permission;
use App\PermissionRole;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        $Permission = Permission::where('permission_name', $permission)->first();
        $PermissionRole = PermissionRole::where('role_id', Auth::user()->role_id)->where('permission_id',$Permission->permission_id)->first();
        if (!$PermissionRole) {
            return response([
                'status' => 'Failed',
                'message' => 'Kamu tidak memiliki akses ke api ini',
                'data' => null
            ], 403);
        }

        return $next($request);
    }
}
