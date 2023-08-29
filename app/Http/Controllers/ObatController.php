<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Obat;

class ObatController extends Controller
{
    // Menampilkan daftar obat
    public function index(Request $request)
    {
        $query = Obat::query();

        if ($request->has('nama_obat')) {
            $query->where('nama_obat',  $request->input('nama_obat'));
        }
        if ($request->has('obat_id')) {
            $query->where('obat_id',  $request->input('obat_id'));
        }

        $obat = $query->get();

        return $this->sendResponse('Success', 'Daftar Obat berhasil diambil', $obat, 200);
    }

    //tambah obat
    public function create(Request $request)
    {
        $this->validate($request, [
            'nama_obat' => 'nullable|string|max:80',
            'dasar' => 'required|numeric',
            'harga_beli' => 'nullable|numeric',
            'ralan' => 'nullable|numeric',
            'harga_kelas_1' => 'nullable|numeric',
            'harga_kelas_2' => 'nullable|numeric',
            'harga_kelas_3' => 'nullable|numeric',
            'harga_utama' => 'nullable|numeric',
            'harga_vip' => 'nullable|numeric',
            'harga_vvip' => 'nullable|numeric',
            'harga_beli_luar' => 'nullable|numeric',
            'harga_jual_bebas' => 'nullable|numeric',
            'harga_karyawan' => 'nullable|numeric',
            'stok_minimal' => 'nullable|numeric',
            'stok' => 'nullable|numeric',
            'expire' => 'nullable|date',
            'status' => 'required|in:0,1',
        ]);

        $obatData = $request->all();
        $obat = Obat::create($obatData);

        if ($obat) {
            return $this->sendResponse('Success', 'Berhasil tambah obat', $obat, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Obat', null, 500);
        }
    }

    public function update(Request $request, $obat_id)
    {
        $this->validate($request, [
            'nama_obat' => 'nullable|string|max:80',
            'dasar' => 'required|numeric',
            'harga_beli' => 'nullable|numeric',
            'ralan' => 'nullable|numeric',
            'harga_kelas_1' => 'nullable|numeric',
            'harga_kelas_2' => 'nullable|numeric',
            'harga_kelas_3' => 'nullable|numeric',
            'harga_utama' => 'nullable|numeric',
            'harga_vip' => 'nullable|numeric',
            'harga_vvip' => 'nullable|numeric',
            'harga_beli_luar' => 'nullable|numeric',
            'harga_jual_bebas' => 'nullable|numeric',
            'harga_karyawan' => 'nullable|numeric',
            'stok_minimal' => 'nullable|numeric',
            'stok' => 'nullable|numeric',
            'expire' => 'nullable|date',
            'status' => 'required|in:0,1',
        ]);
        
        $obatData = $request->all();
        $obat = Obat::where('obat_id', $obat_id)->update($obatData);

        if ($obat) {
            return $this->sendResponse('Success', 'Berhasil update obat', $obat, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Obat', null, 500);
        }
    }
}
