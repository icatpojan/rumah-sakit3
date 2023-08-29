<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departemen;

class DepartemenController extends Controller
{
    // Menampilkan daftar departemen
    public function index(Request $request)
    {
        $query = Departemen::query();

        if ($request->has('nama_departemen')) {
            $query->where('nama_departemen',  $request->input('nama_departemen'));
        }
        if ($request->has('departemen_id')) {
            $query->where('departemen_id',  $request->input('departemen_id'));
        }

        $departemen = $query->get();

        return $this->sendResponse('Success', 'Daftar Departemen berhasil diambil', $departemen, 200);
    }

    //tambah departemen
    public function create(Request $request)
    {
        $this->validate($request, [
            'nama_departemen' => 'required|string',
        ]);


        $departemenData = $request->all();
        $departemen = Departemen::create($departemenData);

        if ($departemen) {
            return $this->sendResponse('Success', 'Berhasil tambah departemen', $departemen, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Departemen', null, 500);
        }
    }

    public function update(Request $request, $departemen_id)
    {
        $this->validate($request, [
            'nama_departemen' => 'required|string',
        ]);

        $departemenData = $request->all();
        $departemen = Departemen::where('departemen_id', $departemen_id)->update($departemenData);

        if ($departemen) {
            return $this->sendResponse('Success', 'Berhasil update departemen', $departemen, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Departemen', null, 500);
        }
    }
}
