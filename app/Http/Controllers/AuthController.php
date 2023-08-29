<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        //set validation
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        //get credentials from request
        $credentials = $request->only('username', 'password');

        //if auth failed
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return $this->sendResponse('Failed', 'Email atau Password Anda salah', null, 401);
        }
        $token = 'Bearer ' . $token;
        $user = auth()->guard('api')->user();

        return $this->sendResponse('Success', 'Berhasil Login', compact('user', 'token'), 200);
    }

    public function logout(Request $request)
    {
        if ($user = Auth::user()) {
            return $this->sendResponse('Success', 'Berhasil logout', null, 200);
        };
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'nama_pasien' => 'required',
            'nik' => 'required'
        ]);

        $user = User::create([
            'username' => $request->nama_pasien,
            'password' => bcrypt($request->nik),
            'role_id' => 3,
        ]);

        $pasienData = $request->all();
        $pasienData['user_id'] = $user->user_id;
        $pasien = Pasien::create($pasienData);

        if ($pasien) {
            return $this->sendResponse('Success', 'Berhasil tambah pasien', $pasien, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Pasien', null, 500);
        }
    }
}
