<?php

namespace App\Http\Controllers;

use App\Pemeliharaan;
use Illuminate\Http\Request;

class PemeliharaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemeliharaan::query();

        if ($request->has('pemeliharaan_id')) {
            $query->where('pemeliharaan_id',  $request->input('pemeliharaan_id'));
        }

        if ($request->has('inventaris_id')) {
            $query->where('inventaris_id',  $request->input('inventaris_id'));
        }

        $pemeliharaan = $query->get();

        return $this->sendResponse('Success', 'Daftar pemeliharaan berhasil diambil', $pemeliharaan, 200);
    }

    //tambah barang
    public function create(Request $request)
    {
        $this->validate($request, [
            'inventaris_id' => 'required|integer',
            'tgl_pemeliharaan' => 'required|date',
            'lama_pemeliharaan' => 'required|string|max:255',
            'uraian_kegiatan' => 'nullable|string|max:255',
            'pelaksana' => 'nullable|string|max:255',
            'biaya' => 'nullable|numeric',
            'jenis_pemeliharaan' => 'nullable|in:Running Maintenance,Shutdown Maintenance,Emergency Maintenance,Preventive Maintenance',
        ]);

        $pemeliharaanData = $request->all();
        $pemeliharaan = Pemeliharaan::create($pemeliharaanData);

        if ($pemeliharaan) {
            return $this->sendResponse('Success', 'Berhasil tambah pemeliharaan', $pemeliharaan, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data pemeliharaan', null, 500);
        }
    }

    public function update(Request $request, $pemeliharaan_id)
    {
        $this->validate($request, [
            'inventaris_id' => 'required|integer',
            'tgl_pemeliharaan' => 'required|date',
            'lama_pemeliharaan' => 'required|string|max:255',
            'uraian_kegiatan' => 'nullable|string|max:255',
            'pelaksana' => 'nullable|string|max:255',
            'biaya' => 'nullable|numeric',
            'jenis_pemeliharaan' => 'nullable|in:Running Maintenance,Shutdown Maintenance,Emergency Maintenance,Preventive Maintenance',
        ]);

        $pemeliharaanData = $request->all();
        $pemeliharaan = Pemeliharaan::where('pemeliharaan_id', $pemeliharaan_id)->update($pemeliharaanData);

        if ($pemeliharaan) {
            return $this->sendResponse('Success', 'Berhasil update pemeliharaan', $pemeliharaan, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data pemeliharaan', null, 500);
        }
    }
}
