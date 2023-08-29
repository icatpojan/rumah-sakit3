<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Poliklinik;

class PoliklinikController extends Controller
{
    // Menampilkan daftar poliklinik
    public function index(Request $request)
    {
        $query = Poliklinik::query();

        if ($request->has('nama_poliklinik')) {
            $query->where('nama_poliklinik',  $request->input('nama_poliklinik'));
        }

        if ($request->has('poliklinik_id')) {
            $query->where('poliklinik_id',  $request->input('poliklinik_id'));
        }

        $poliklinik = $query->get();

        return $this->sendResponse('Success', 'Daftar Poliklinik berhasil diambil', $poliklinik, 200);
    }

    //tambah poliklinik
    public function create(Request $request)
    {
        $this->validate($request, [
            'nama_poliklinik' => 'required|string|max:255',
            'regristasi_baru' => 'nullable|integer',
            'regristasi_lama' => 'nullable|integer',
        ]);

        $poliklinikData = $request->all();
        $poliklinik = Poliklinik::create($poliklinikData);

        if ($poliklinik) {
            return $this->sendResponse('Success', 'Berhasil tambah poliklinik', $poliklinik, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Poliklinik', null, 500);
        }
    }

    public function update(Request $request, $poliklinik_id)
    {
        $this->validate($request, [
            'nama_poliklinik' => 'required|string|max:255',
            'regristasi_baru' => 'nullable|integer',
            'regristasi_lama' => 'nullable|integer',
        ]);

        $poliklinikData = $request->all();
        $poliklinik = Poliklinik::where('poliklinik_id', $poliklinik_id)->update($poliklinikData);

        if ($poliklinik) {
            return $this->sendResponse('Success', 'Berhasil update poliklinik', $poliklinik, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Poliklinik', null, 500);
        }
    }
}
