<?php

namespace App\Http\Controllers;

use App\Dokter;
use App\Pegawai;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    // Menampilkan daftar dokter
    public function index(Request $request)
    {
        $query = Dokter::query();

        if ($request->has('dokter_id')) {
            $query->where('dokter_id',  $request->input('dokter_id'));
        }

        $dokter = $query->with(['pegawai'])->get();

        return $this->sendResponse('Success', 'Daftar Dokter berhasil diambil', $dokter, 200);
    }

    //tambah dokter
    public function create(Request $request)
    {
        $this->validate($request, [
            'pegawai_id' => 'required|integer',
            'kode_spesialis' => 'nullable|string|max:5',
            'no_ijn_praktek' => 'nullable|string|max:120',
            'status' => 'nullable|in:0,1',
        ]);

        $dokterData = $request->all();
        if (Dokter::where('pegawai_id',$request->pegawai_id)->first()|| !$Pegawai = Pegawai::where('pegawai_id', $request->pegawai_id)->first()) {
            return $this->sendResponse('Error', 'Pegawai ini sudah menjadi dokter atau id pegwai tidak ada', null, 500);
        }
        $dokter = Dokter::create($dokterData);

        if ($dokter) {
            return $this->sendResponse('Success', 'Berhasil tambah dokter', $dokter, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Dokter', null, 500);
        }
    }
    // update dokter
    public function update(Request $request, $dokter_id)
    {
        $this->validate($request, [
            'pegawai_id' => 'required|integer',
            'kode_spesialis' => 'nullable|string|max:5',
            'no_ijn_praktek' => 'nullable|string|max:120',
            'status' => 'nullable|in:0,1',
        ]);

        $dokterData = $request->all();
        $dokter = Dokter::where('dokter_id', $dokter_id)->update($dokterData);

        if ($dokter) {
            return $this->sendResponse('Success', 'Berhasil update dokter', $dokter, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Dokter', null, 500);
        }
    }
}
