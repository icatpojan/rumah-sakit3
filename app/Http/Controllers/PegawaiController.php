<?php

namespace App\Http\Controllers;

use App\Departemen;
use App\Http\Requests\PegawaiRequest;
use App\Pegawai;
use App\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    // Menampilkan daftar pegawai
    public function index(Request $request)
    {
        $query = Pegawai::query();

        if ($request->has('pegawai_id')) {
            $query->where('pegawai_id',  $request->input('pegawai_id'));
        }

        $pegawai = $query->with(['akun'])->get();

        return $this->sendResponse('Success', 'Daftar Pegawai berhasil diambil', $pegawai, 200);
    }

    //tambah pegawai
    public function create(PegawaiRequest $request)
    {
        if (!$Departemen = Departemen::where('departemen_id',$request->departemen_id)->first()) {
            return $this->sendResponse('Failed', 'departemen id tidak ada. masukan dulu data', null, 400);
        }
        $user = User::create([
            'username' => $request->nama_pegawai,
            'password' => bcrypt($request->nik),
            'role_id' => 3,
        ]);

        $pegawaiData = $request->all();
        $pegawaiData['user_id'] = $user->user_id;
        $pegawai = Pegawai::create($pegawaiData);

        if ($pegawai) {
            return $this->sendResponse('Success', 'Berhasil tambah pegawai', $pegawai, 200);
        } else {
            return $this->sendResponse('Failed', 'Gagal menambahkan data Pegawai', null, 400);
        }
    }

    public function update(PegawaiRequest $request, $pegawai_id)
    {
        if (!$Departemen = Departemen::where('departemen_id', $request->departemen_id)->first()) {
            return $this->sendResponse('Failed', 'departemen id tidak ada. masukan dulu data', null, 400);
        }
        $pegawaiData = $request->all();
        $pegawai = Pegawai::where('pegawai_id', $pegawai_id)->update($pegawaiData);

        if ($pegawai) {
            return $this->sendResponse('Success', 'Berhasil update pegawai', $pegawai, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Pegawai', null, 400);
        }
    }
}
