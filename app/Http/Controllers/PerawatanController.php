<?php

namespace App\Http\Controllers;

use App\Http\Requests\PerawatanRequest;
use Illuminate\Http\Request;
use App\Perawatan;

class PerawatanController extends Controller
{
    // Menampilkan daftar perawatan
    public function index(Request $request)
    {
        $query = Perawatan::query();

        if ($request->has('nama_perawatan')) {
            $query->where('nama_perawatan',  $request->input('nama_perawatan'));
        }

        if ($request->has('perawatan_id')) {
            $query->where('perawatan_id',  $request->input('perawatan_id'));
        }

        if ($request->has('poliklinik_id')) {
            $query->where('poliklinik_id',  $request->input('poliklinik_id'));
        }

        $perawatan = $query->get();

        return $this->sendResponse('Success', 'Daftar Perawatan berhasil diambil', $perawatan, 200);
    }

    //tambah perawatan
    public function create(PerawatanRequest $request)
    {
        $perawatanData = $request->all();
        $perawatan = Perawatan::create($perawatanData);

        if ($perawatan) {
            return $this->sendResponse('Success', 'Berhasil tambah perawatan', $perawatan, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Perawatan', null, 500);
        }
    }

    public function update(PerawatanRequest $request, $perawatan_id)
    {
        $perawatanData = $request->all();
        $perawatan = Perawatan::where('perawatan_id', $perawatan_id)->update($perawatanData);

        if ($perawatan) {
            return $this->sendResponse('Success', 'Berhasil update perawatan', $perawatan, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Perawatan', null, 500);
        }
    }
}
