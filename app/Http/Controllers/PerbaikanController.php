<?php

namespace App\Http\Controllers;

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

        if ($request->has('letak_barang')) {
            $query->where('letak_barang',  $request->input('letak_barang'));
        }

        if ($request->has('pegawai_id')) {
            $query->where('pegawai_id',  $request->input('pegawai_id'));
        }

        $perbaikan = $query->get();

        return $this->sendResponse('Success', 'Daftar Perbaikan berhasil diambil', $perbaikan, 200);
    }

    //tambah perbaikan
    public function create(Request $request)
    {
        $this->validate($request, [
            'barang_id' => 'required|integer',
            'letak_barang' => 'required|string',
            'status' => 'nullable|string',
            'pegawai_id' => 'nullable|string',
        ]);

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
            'barang_id' => 'required|integer',
            'letak_barang' => 'required|string',
            'status' => 'nullable|string',
            'pegawai_id' => 'nullable|string',
        ]);

        $perbaikanData = $request->all();
        $perbaikan = Perbaikan::where('perbaikan_id', $perbaikan_id)->update($perbaikanData);

        if ($perbaikan) {
            return $this->sendResponse('Success', 'Berhasil update perbaikan', $perbaikan, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Perbaikan', null, 500);
        }
    }
}
