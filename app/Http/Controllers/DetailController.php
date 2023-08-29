<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Detail;
use App\DetailObat;
use App\DetailTambahan;
use App\Obat;
use App\Perawatan;

class DetailController extends Controller
{
    // Menampilkan daftar detail
    public function indexDetail(Request $request)
    {
        $query = Detail::query();

        if ($request->has('detail_id')) {
            $query->where('detail_id',  $request->input('detail_id'));
        }

        if ($request->has('regristasi_id')) {
            $query->where('regristasi_id',  $request->input('regristasi_id'));
        }

        $detail = $query->get();

        return $this->sendResponse('Success', 'Daftar Detail berhasil diambil', $detail, 200);
    }

    // Menampilkan daftar detail obat
    public function indexDetailObat(Request $request)
    {
        $query = DetailObat::query();

        if ($request->has('detail_obat_id')) {
            $query->where('detail_obat_id',  $request->input('detail_obat_id'));
        }

        if ($request->has('regristasi_id')) {
            $query->where('regristasi_id',  $request->input('regristasi_id'));
        }

        $detail = $query->get();

        return $this->sendResponse('Success', 'Daftar Detail Obat berhasil diambil', $detail, 200);
    }

    // Menampilkan daftar detail tambahan
    public function indexDetailTambahan(Request $request)
    {
        $query = DetailTambahan::query();

        if ($request->has('detail_tambahan_id')) {
            $query->where('detail_tambahan_id',  $request->input('detail_tambahan_id'));
        }

        if ($request->has('regristasi_id')) {
            $query->where('regristasi_id',  $request->input('regristasi_id'));
        }

        $detail = $query->get();

        return $this->sendResponse('Success', 'Daftar Detail Tambahan berhasil diambil', $detail, 200);
    }

    //tambah detail
    public function createDetail(Request $request)
    {
        $this->validate($request, [
            'regristasi_id' => 'required|integer',
            'perawatan_id' => 'required|string|max:15',
            'dokter_id' => 'required|string|max:20',
        ]);

        if ($Perawatan = Perawatan::where('perawatan_id', $request->perawatan_id)->first()) {
            $detail = Detail::create([
                'regristasi_id' => $request->regristasi_id,
                'perawatan_id' => $request->perawatan_id,
                'dokter_id' => $request->dokter_id,
                'tgl_perawatan' => now(),
                'jam_rawat' => date("H:i:s"),
                'bagian_rs' => $Perawatan->bagian_rs,
                'bhp' => $Perawatan->bhp,
                'tarif_perujuk' => $Perawatan->tarif_perujuk,
                'tarif_tindakan_dokter' => $Perawatan->tarif_tindakan_dokter,
                'tarif_tindakan_petugas' => $Perawatan->tarif_tindakan_petugas,
                'kso' => $Perawatan->kso,
                'menejemen' => $Perawatan->menejemen,
                'total_biaya' => $Perawatan->total_biaya,
                'status_bayar' => 'belum'
            ]);
            return $this->sendResponse('Success', 'Berhasil tambah detail', $detail, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Detail', null, 400);
        }
    }

    public function updateDetail(Request $request, $detail_id)
    {
        $this->validate($request, [
            'regristasi_id' => 'required|integer',
            'perawatan_id' => 'required|string|max:15',
            'dokter_id' => 'required|string|max:20',
        ]);

        if ($Perawatan = Perawatan::where('perawatan_id', $request->perawatan_id)->first()) {
            $detail = Detail::where('detail_id', $detail_id)->update([
                'regristasi_id' => $request->regristasi_id,
                'perawatan_id' => $request->perawatan_id,
                'dokter_id' => $request->dokter_id,
                'tgl_perawatan' => now(),
                'jam_rawat' => date("H:i:s"),
                'bagian_rs' => $Perawatan->bagian_rs,
                'bhp' => $Perawatan->bhp,
                'tarif_perujuk' => $Perawatan->tarif_perujuk,
                'tarif_tindakan_dokter' => $Perawatan->tarif_tindakan_dokter,
                'tarif_tindakan_petugas' => $Perawatan->tarif_tindakan_petugas,
                'kso' => $Perawatan->kso,
                'menejemen' => $Perawatan->menejemen,
                'total_biaya' => $Perawatan->total_biaya,
                'status_bayar' => 'belum'
            ]);
            return $this->sendResponse('Success', 'Berhasil mengupdate detail', $detail, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Detail', null, 400);
        }
    }

    //tambah detailObat
    public function createDetailObat(Request $request)
    {
        $this->validate($request, [
            'regristasi_id' => 'required|numeric',
            'obat_id' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);

        if ($Obat = Obat::where('obat_id', $request->obat_id)->first()) {
            $detail = DetailObat::create([
                'regristasi_id' => $request->regristasi_id,
                'obat_id' => $request->obat_id,
                'dokter_id' => $request->dokter_id,
                'jumlah' => $request->jumlah,

                'harga_beli' => $Obat->harga_beli,
                'biaya_obat' => $Obat->ralan,
                'total_biaya' => $Obat->ralan * $request->jumlah,
            ]);
            return $this->sendResponse('Success', 'Berhasil tambah detail obat', $detail, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Detail obat', null, 400);
        }
    }

    public function updateDetailObat(Request $request, $detailObat_id)
    {
        $this->validate($request, [
            'regristasi_id' => 'required|numeric',
            'obat_id' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ]);

        if ($Obat = Obat::where('obat_id', $request->obat_id)->first()) {
            $detail = DetailObat::where('detail_obat_id', $detailObat_id)->update([
                'regristasi_id' => $request->regristasi_id,
                'obat_id' => $request->obat_id,
                'dokter_id' => $request->dokter_id,
                'jumlah' => $request->jumlah,

                'harga_beli' => $Obat->harga_beli,
                'biaya_obat' => $Obat->ralan,
                'total_biaya' => $Obat->ralan * $request->jumlah,
            ]);
            return $this->sendResponse('Success', 'Berhasil update detail obat', $detail, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal update data Detail obat', null, 400);
        }
    }

    //tambah detailTambahan
    public function createDetailTambahan(Request $request)
    {
        $detailTambahanData = $request->all();
        $detailTambahan = DetailTambahan::create($detailTambahanData);

        if ($detailTambahan) {
            return $this->sendResponse('Success', 'Berhasil tambah detailTambahan', $detailTambahan, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data DetailTambahan', null, 400);
        }
    }

    public function updateDetailTambahan(Request $request, $detailTambahan_id)
    {
        $detailTambahanData = $request->all();
        $detailTambahan = DetailTambahan::where('detailTambahan_id', $detailTambahan_id)->update($detailTambahanData);

        if ($detailTambahan) {
            return $this->sendResponse('Success', 'Berhasil update detailTambahan', $detailTambahan, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data DetailTambahan', null, 400);
        }
    }
}
