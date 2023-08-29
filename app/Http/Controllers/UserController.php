<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    // Menampilkan daftar user
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('user_id')) {
            $query->where('user_id',  $request->input('user_id'));
        }

        if ($request->has('username')) {
            $query->where('username', 'like', '%' . $request->input('username') . '%');
        }

        if ($request->has('role')) {
            $query->where(
                'role',
                'like',
                '%' . $request->input('role') . '%'
            );
        }

        $users = $query->get(['user_id', 'username', 'role_id']);

        return $this->sendResponse('Success', 'Daftar User berhasil diambil', $users, 200);
    }

    // Menghapus user berdasarkan ID
    public function destroy($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return $this->sendResponse('Error', 'User tidak ditemukan', null, 404);
        }
        $user->delete();
        return $this->sendResponse('Success', 'User berhasil dihapus', null, 200);
    }
}
