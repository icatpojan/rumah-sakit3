<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Regristasi;

class RalanController extends Controller
{
    // Menampilkan daftar regristasi
    public function index(Request $request)
    {
        $query = Regristasi::query();

        if ($request->has('regristasi_id')) {
            $query->where('regristasi_id',  $request->input('regristasi_id'));
        }

        if ($request->has('pasien_id')) {
            $query->where('pasien_id',  $request->input('pasien_id'));
        }

        if ($request->has('dokter_id')) {
            $query->where('dokter_id',  $request->input('dokter_id'));
        }
        $regristasi = $query->get();

        return $this->sendResponse('Success', 'Daftar Regristasi berhasil diambil', $regristasi, 200);
    }

    //tambah regristasi
    public function create(Request $request)
    {
        $this->validate($request, [
            'no_regristasi' => 'nullable|string|max:8',
            'pasien_id' => 'required|integer',
            'tgl_registrasi' => 'nullable|date',
            'jam_reg' => 'nullable|date_format:H:i:s',
            'dokter_id' => 'required|integer',
            'no_rekam_medis' => 'nullable|string|max:15',
            'poliklinik_id' => 'required|integer',
            'penjamin' => 'required|string|max:100',
            'alamat_pj' => 'nullable|string|max:200',
            'hubungan_pj' => 'nullable|string|max:20',
            'biaya_regristasi' => 'nullable|numeric',
            'status' => 'nullable|in:Belum,Sudah,Batal,Berkas Diterima,Dirujuk,Meninggal,Dirawat,Pulang Paksa',
            'status_bayar' => 'nullable|in:Sudah Bayar,Belum Bayar',
            'status_daftar' => 'nullable|in:Lama,Baru',
            'status_lanjut' => 'nullable|in:Ralan,Ranap',
        ]);

        $regristasiData = $request->all();
        $regristasi = Regristasi::create($regristasiData);

        if ($regristasi) {
            return $this->sendResponse('Success', 'Berhasil tambah regristasi', $regristasi, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Regristasi', null, 500);
        }
    }

    public function update(Request $request, $regristasi_id)
    {
        $this->validate($request, [
            'no_regristasi' => 'nullable|string|max:8',
            'pasien_id' => 'required|integer',
            'tgl_registrasi' => 'nullable|date',
            'jam_reg' => 'nullable|date_format:H:i:s',
            'dokter_id' => 'required|integer',
            'no_rekam_medis' => 'nullable|string|max:15',
            'poliklinik_id' => 'required|integer',
            'penjamin' => 'required|string|max:100',
            'alamat_pj' => 'nullable|string|max:200',
            'hubungan_pj' => 'nullable|string|max:20',
            'biaya_regristasi' => 'nullable|numeric',
            'status' => 'nullable|in:Belum,Sudah,Batal,Berkas Diterima,Dirujuk,Meninggal,Dirawat,Pulang Paksa',
            'status_bayar' => 'nullable|in:Sudah Bayar,Belum Bayar',
            'status_daftar' => 'nullable|in:Lama,Baru',
            'status_lanjut' => 'nullable|in:Ralan,Ranap',
        ]);

        $regristasiData = $request->all();
        $regristasi = Regristasi::where('regristasi_id', $regristasi_id)->update($regristasiData);

        if ($regristasi) {
            return $this->sendResponse('Success', 'Berhasil update regristasi', $regristasi, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Regristasi', null, 500);
        }
    }
}
