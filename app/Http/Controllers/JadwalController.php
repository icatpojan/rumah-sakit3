<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;

class JadwalController extends Controller
{
    // Menampilkan daftar jadwal
    public function index(Request $request)
    {
        $query = Jadwal::query();

        if ($request->has('jadwal_id')) {
            $query->where('jadwal_id',  $request->input('jadwal_id'));
        }

        if ($request->has('pegawai_id')) {
            $query->where('pegawai_id',  $request->input('pegawai_id'));
        }

        $jadwal = $query->get();

        return $this->sendResponse('Success', 'Daftar Jadwal berhasil diambil', $jadwal, 200);
    }

    //tambah jadwal
    public function create(Request $request)
    {
        $this->validate($request, [
            'pegawai_id' => 'required|integer',
            'tahun' => 'required|integer',
            'bulan' => 'required|integer',
        ]);

        $jadwalData = $request->all();
        $jadwal = Jadwal::create($jadwalData);

        if ($jadwal) {
            return $this->sendResponse('Success', 'Berhasil tambah jadwal', $jadwal, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Jadwal', null, 500);
        }
    }

    public function update(Request $request, $jadwal_id)
    {
        $this->validate($request, [
            'pegawai_id' => 'required|integer',
            'tahun' => 'required|integer',
            'bulan' => 'required|integer',
        ]);
        
        $jadwalData = $request->all();
        $jadwal = Jadwal::where('jadwal_id', $jadwal_id)->update($jadwalData);

        if ($jadwal) {
            return $this->sendResponse('Success', 'Berhasil update jadwal', $jadwal, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Jadwal', null, 500);
        }
    }
}
