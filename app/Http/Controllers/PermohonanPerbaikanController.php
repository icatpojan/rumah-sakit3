<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Pegawai;
use App\PermohonanPerbaikan;
use Illuminate\Http\Request;

class PermohonanPerbaikanController extends Controller
{
    public function index(Request $request)
    {
        $query = PermohonanPerbaikan::query();

        if ($request->has('permohonan_perbaikan_id')) {
            $query->where('permohonan_perbaikan_id', $request->input('permohonan_perbaikan_id'));
        }

        if ($request->has('barang_id')) {
            $query->where('barang_id', $request->input('barang_id'));
        }

        $permohonan = $query->get();

        if ($permohonan) {
            return $this->sendResponse('Success', 'Daftar permohonan perbaikan berhasil diambil', $permohonan, 200);
        } else {
            return $this->sendResponse('Error', 'Daftar permohonan perbaikan gagal diambil', null, 500);
        }
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'barang_id' => 'required|integer',
            'pegawai_id' => 'required|integer',
            'tgl_permohonan' => 'nullable|date',
            'deskripsi_kerusakan' => 'nullable|string|max:255',
        ]);

        if (!$pegawai = Pegawai::find($request->pegawai_id) || !$barang = Barang::find($request->barang_id)) {
            return $this->sendResponse('failed', 'id barang atau pegawai tidak ada', null, 400);
        }

        $permohonanData = $request->all();
        $permohonan = PermohonanPerbaikan::create($permohonanData);

        if ($permohonan) {
            return $this->sendResponse('Success', 'Berhasil tambah permohonan perbaikan', $permohonan, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data permohonan perbaikan', null, 500);
        }
    }

    public function update(Request $request, $permohonan_perbaikan_id)
    {
        $this->validate($request, [
            'barang_id' => 'required|integer',
            'pegawai_id' => 'required|integer',
            'tgl_permohonan' => 'nullable|date',
            'deskripsi_kerusakan' => 'nullable|string|max:255',
        ]);

        if (!$pegawai = Pegawai::find($request->pegawai_id) || !$barang = Barang::find($request->barang_id)) {
            return $this->sendResponse('failed', 'id barang atau pegawai tidak ada', null, 400);
        }
        
        $permohonanData = $request->all();
        $permohonan = PermohonanPerbaikan::where('permohonan_perbaikan_id', $permohonan_perbaikan_id)->update($permohonanData);

        if ($permohonan) {
            return $this->sendResponse('Success', 'Berhasil update permohonan perbaikan', $permohonan, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data permohonan perbaikan', null, 500);
        }
    }
}
