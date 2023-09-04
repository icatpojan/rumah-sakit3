<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasienRequest;
use App\Pasien;
use App\User;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    // Menampilkan daftar pasien
    public function index(Request $request)
    {
        $query = Pasien::query();

        if ($request->has('pasien_id')) {
            $query->where('pasien_id',  $request->input('pasien_id'));
        }

        $pasien = $query->with(['akun'])->get();

        return $this->sendResponse('Success', 'Daftar Pasien berhasil diambil', $pasien, 200);
    }

    //tambah pasien
    public function create(PasienRequest $request)
    {
        $user = User::create([
            'username' => $request->nama_pasien,
            'password' => bcrypt($request->nik),
            'role_id' => 3,
        ]);

        $pasienData = $request->all();
        $pasienData['user_id'] = $user->user_id;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/img/', $filename);
            $pasienData['image'] = env('APP_URL') . $filename;
        }
        $pasien = Pasien::create($pasienData);

        if ($pasien) {
            return $this->sendResponse('Success', 'Berhasil tambah pasien', $pasien, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Pasien', null, 500);
        }
    }

    public function update(PasienRequest $request, $pasien_id)
    {
        $pasienData = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . '/img/', $filename);
            $pasienData['image'] = env('APP_URL') . $filename;
        }
        $pasien = Pasien::where('pasien_id', $pasien_id)->update($pasienData);

        if ($pasien) {
            return $this->sendResponse('Success', 'Berhasil update pasien', $pasien, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Pasien', null, 500);
        }
    }
}
