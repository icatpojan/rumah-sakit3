<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pegawai;
use App\PermohonanPerbaikan;
use Illuminate\Http\Request;
use App\Perbaikan;

class PerbaikanController extends Controller
{
    // Menampilkan daftar perbaikan
    public function index(Request $request)
    {
        $query = Perbaikan::query();

        if ($request->has('perbaikan_id')) {
            $query->where('perbaikan_id',  $request->input('perbaikan_id'));
        }

        if ($request->has('permohonan_perbaikan_id')) {
            $query->where('permohonan_perbaikan_id',  $request->input('permohonan_perbaikan_id'));
        }

        $perbaikan = $query->get();

        return $this->sendResponse('Success', 'Daftar perbaikan berhasil diambil', $perbaikan, 200);
    }

    //tambah perbaikan
    public function create(Request $request)
    {
        $this->validate($request, [
            'permohonan_perbaikan_id' => 'required|integer',
            'pelaksana' => 'nullable|string',
            'tgl_perbaikan' => 'nullable|date',
            'lama_perbaikan' => 'nullable|string',
            'uraian_kegiatan' => 'nullable|string',
            'biaya' => 'nullable|numeric',
            'status' => 'nullable|in:0,1',
        ]);

        if (!$permohonan = PermohonanPerbaikan::find($request->permohonan_perbaikan_id)) {
            return $this->sendResponse('failed', 'id permohonan tidak ada', null, 400);
        }

        $perbaikanData = $request->all();
        $perbaikan = Perbaikan::create($perbaikanData);

        if ($perbaikan) {
            return $this->sendResponse('Success', 'Berhasil tambah perbaikan', $perbaikan, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Perbaikan', null, 500);
        }
    }

    public function update(Request $request, $perbaikan_id)
    {
        $this->validate($request, [
            'permohonan_perbaikan_id' => 'required|integer',
            'pelaksana' => 'nullable|string',
            'tgl_perbaikan' => 'nullable|date',
            'lama_perbaikan' => 'nullable|string',
            'uraian_kegiatan' => 'nullable|string',
            'biaya' => 'nullable|numeric',
            'status' => 'nullable|in:0,1',
        ]);

        if (!$permohonan = PermohonanPerbaikan::find($request->permohonan_perbaikan_id)) {
            return $this->sendResponse('failed', 'id permohonan tidak ada', null, 400);
        }
        
        $perbaikanData = $request->all();
        $perbaikan = Perbaikan::where('perbaikan_id', $perbaikan_id)->update($perbaikanData);

        if ($perbaikan) {
            return $this->sendResponse('Success', 'Berhasil update perbaikan', $perbaikan, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Perbaikan', null, 500);
        }
    }
}
