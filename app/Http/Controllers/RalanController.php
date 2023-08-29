<?php

namespace App\Http\Controllers;

use App\Poliklinik;
use Illuminate\Http\Request;
use App\Regristasi;
use Carbon\Carbon;

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
            'pasien_id' => 'required|integer',
            'tgl_registrasi' => 'nullable|date',
            'jam_reg' => 'nullable|date_format:H:i:s',
            'dokter_id' => 'required|integer',
            'poliklinik_id' => 'required|integer',
            'penjamin' => 'required|string|max:100',
            'alamat_pj' => 'nullable|string|max:200',
            'hubungan_pj' => 'nullable|string|max:20',
        ]);

        $regristasiData = $request->all();
        $regristasiData['no_regristasi'] = Carbon::now()->format('Y/m/d') . '/' . Regristasi::latest('regristasi_id')->value('regristasi_id');
        $Poliklinik = Poliklinik::where('poliklinik_id',$request->poliklinik_id)->first();
        if (!$regristasi = Regristasi::where('pasien_id',$request->pasien_id)->first()) {
            $regristasiData['biaya_regristasi'] = $Poliklinik->regristasi_baru;
            $regristasiData['status_daftar'] = 'baru';
        }else{
            $regristasiData['biaya_regristasi'] = $Poliklinik->regristasi_lama;
            $regristasiData['status_daftar'] = 'lama';
        }

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
            'pasien_id' => 'nullable|integer',
            'tgl_registrasi' => 'nullable|date',
            'jam_reg' => 'nullable|date_format:H:i:s',
            'dokter_id' => 'nullable|integer',
            'poliklinik_id' => 'nullable|integer',
            'penjamin' => 'nullable|string|max:100',
            'alamat_pj' => 'nullable|string|max:200',
            'hubungan_pj' => 'nullable|string|max:20',
            'biaya_regristasi' => 'nullable|numeric',
            'status' => 'nullable|in:belum,sudah,batal,berkas diterima,dirujuk,meninggal,dirawat,pulang paksa',
            'status_bayar' => 'nullable|in:sudah,belum',
            'status_daftar' => 'nullable|in:lama,baru',
            'status_lanjut' => 'nullable|in:ralan,Ranap',
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
