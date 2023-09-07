<?php

namespace App\Http\Controllers;

use App\PermohonanPerbaikan;
use Illuminate\Http\Request;

class PermohonanPerbaikanController extends Controller
{
    public function index(Request $request)
    {
        $query = PermohonanPerbaikan::query();

        if ($request->has('permohonan_id')) {
            $query->where('permohonan_id', $request->input('permohonan_id'));
        }

        if ($request->has('perbaikan_id')) {
            $query->where('perbaikan_id', $request->input('perbaikan_id'));
        }

        $permohonan = $query->get();

        return $this->sendResponse('Success', 'Daftar permohonan berhasil diambil', $permohonan, 200);
    }

    //tambah barang
    public function create(Request $request)
    {
        $this->validate($request, [
            'perbaikan_id' => 'required|integer',
            'tgl_permohonan' => 'required|date',
            'deskripsi_kerusakan' => 'required|string|max:255',
            'pelaksana' => 'nullable|string|max:255',
            'biaya' => 'nullable|numeric',
            'status' => 'nullable|in:sedang diperbaiki,selesai diperbaiki,tidak bisa diperbaiki',
        ]);

        $permohonanData = $request->all();
        $permohonan = PermohonanPerbaikan::create($permohonanData);

        if ($permohonan) {
            return $this->sendResponse('Success', 'Berhasil tambah permohonan', $permohonan, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data permohonan', null, 500);
        }
    }

    public function update(Request $request, $permohonan_id)
    {
        $this->validate($request, [
            'perbaikan_id' => 'required|integer',
            'tgl_permohonan' => 'required|date',
            'deskripsi_kerusakan' => 'required|string|max:255',
            'pelaksana' => 'nullable|string|max:255',
            'biaya' => 'nullable|numeric',
            'status' => 'nullable|in:sedang diperbaiki,selesai diperbaiki,tidak bisa diperbaiki',
        ]);

        $permohonanData = $request->all();
        $permohonan = PermohonanPerbaikan::where('permohonan_id', $permohonan_id)->update($permohonanData);

        if ($permohonan) {
            return $this->sendResponse('Success', 'Berhasil update permohonan', $permohonan, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data permohonan', null, 500);
        }
    }
}