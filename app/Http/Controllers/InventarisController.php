<?php

namespace App\Http\Controllers;

use App\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventaris::query();

        if ($request->has('inventaris_id')) {
            $query->where('inventaris_id', $request->input('inventaris_id'));
        }

        if ($request->has('barang_id')) {
            $query->where('barang_id', $request->input('barang_id'));
        }

        if ($request->has('obat_id')) {
            $query->where('obat_id', $request->input('obat_id'));
        }

        $inventaris = $query->get();

        return $this->sendResponse('Success', 'Daftar Inventaris berhasil diambil', $inventaris, 200);
    }

    //tambah barang
    public function create(Request $request)
    {
        $this->validate($request, [
            'barang_id' => 'nullable|integer',
            'obat_id' => 'nullable|integer',
            'harga' => 'nullable|numeric',
            'tgl_pengadaan' => 'nullable|date',
            'status' => 'required|in:0,1',
        ]);

        $inventarisData = $request->all();
        $inventaris = Inventaris::create($inventarisData);

        if ($inventaris) {
            return $this->sendResponse('Success', 'Berhasil tambah inventaris', $inventaris, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data inventaris', null, 500);
        }
    }

    public function update(Request $request, $inventaris_id)
    {
        $this->validate($request, [
            'barang_id' => 'nullable|integer',
            'obat_id' => 'nullable|integer',
            'harga' => 'nullable|numeric',
            'tgl_pengadaan' => 'nullable|date',
            'status' => 'required|in:ada,rusak,hilang,perbaikan,habis',
        ]);

        $inventarisData = $request->all();
        $inventaris = Inventaris::where('inventaris_id', $inventaris_id)->update($inventarisData);

        if ($inventaris) {
            return $this->sendResponse('Success', 'Berhasil update inventaris', $inventaris, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data inventaris', null, 500);
        }
    }
}
