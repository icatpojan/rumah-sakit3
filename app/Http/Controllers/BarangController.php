<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

class BarangController extends Controller
{
    // Menampilkan daftar barang
    public function index(Request $request)
    {
        $query = Barang::query();

        if ($request->has('nama_barang')) {
            $query->where('nama_barang',  $request->input('nama_barang'));
        }

        if ($request->has('barang_id')) {
            $query->where('barang_id',  $request->input('barang_id'));
        }

        $barang = $query->get();

        return $this->sendResponse('Success', 'Daftar Barang berhasil diambil', $barang, 200);
    }

    //tambah barang
    public function create(Request $request)
    {
        $this->validate($request, [
            'nama_barang' => 'required|string',
            'letak_barang' => 'required|string',
            'jumlah_barang' => 'required|integer',
        ]);

        $barangData = $request->all();
        $barang = Barang::create($barangData);

        if ($barang) {
            return $this->sendResponse('Success', 'Berhasil tambah barang', $barang, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Barang', null, 500);
        }
    }

    public function update(Request $request, $barang_id)
    {
        $this->validate($request, [
            'nama_barang' => 'required|string',
            'letak_barang' => 'required|string',
            'jumlah_barang' => 'required|integer',
        ]);

        $barangData = $request->all();
        $barang = Barang::where('barang_id', $barang_id)->update($barangData);

        if ($barang) {
            return $this->sendResponse('Success', 'Berhasil update barang', $barang, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Barang', null, 500);
        }
    }
}
