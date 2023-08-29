<?php

namespace App\Http\Controllers;

use App\PermissionRole;
use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    // Menampilkan daftar role
    public function index(Request $request)
    {
        $query = Role::query();

        if ($request->has('role_name')) {
            $query->where('role_name',  $request->input('role_name'));
        }
        if ($request->has('role_id')) {
            $query->where('role_id',  $request->input('role_id'));
        }

        $role = $query->with('permission:permission_name')->get();

        return $this->sendResponse('Success', 'Daftar Role berhasil diambil', $role, 200);
    }


    public function update(Request $request, $role_id)
    {
        $requestData = $request->all();

        $permission_ids = explode(',', $requestData['permission_id']);

        // Menghapus permission_role yang sudah ada untuk role_id ini
        PermissionRole::where('role_id', $role_id)->delete();

        // Menambahkan permission_role baru berdasarkan permission_id yang diberikan
        foreach ($permission_ids as $permission_id) {
            PermissionRole::create([
                'role_id' => $role_id,
                'permission_id' => $permission_id,
            ]);
        }
        return $this->sendResponse('Success', 'Berhasil update role', null, 200);
    }
}
