<?php

namespace App\Http\Controllers;

use App\Jadwal;
use Illuminate\Http\Request;
use App\Presensi;
use App\Shift;
use Carbon\Carbon;

class PresensiController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'pegawai_id' => 'required|integer',
        ]);
        try {
            $pegawaiId = $request->input('pegawai_id');
            $lat = $request->input('lat');
            $lon = $request->input('lon');
            $tanggal = Carbon::now()->toDateString();
            $jamSekarang = Carbon::now()->toTimeString();

            // Cek apakah pegawai memiliki jadwal pada tanggal ini
            $jadwal = Jadwal::where('pegawai_id', $pegawaiId)
                ->where('tahun', Carbon::now()->year)
                ->where('bulan', Carbon::now()->month)
                ->first();

            if (!$jadwal) {
                return $this->sendResponse('Failed', 'Anda tidak memiliki jadwal pada tanggal ini', null, 400);
            }

            $shiftColumnName = 'tgl_' . Carbon::now()->day;

            // Cek apakah pegawai memiliki shift pada tanggal ini
            $shiftId = $jadwal->$shiftColumnName;
            if (!$shiftId) {
                return $this->sendResponse('Failed', 'Anda tidak memiliki shift pada tanggal ini', null, 400);
            }

            // Cek apakah sudah ada absen datang atau absen pulang hari ini
            $absenDatang = Presensi::where('pegawai_id', $pegawaiId)
                ->where('tanggal', $tanggal)
                ->where('status', 'datang')
                ->first();

            $absenPulang = Presensi::where('pegawai_id', $pegawaiId)
                ->where('tanggal', $tanggal)
                ->where('status', 'pulang')
                ->first();

            if (!$absenDatang && !$absenPulang) {
                // Lakukan absen datang
                $this->createPresensi($pegawaiId, $shiftId, $tanggal, 'datang', $jamSekarang, $lat, $lon);
                return $this->sendResponse('Success', 'Absen datang berhasil', null, 200);
            } elseif ($absenDatang && !$absenPulang) {
                // Lakukan absen pulang
                $this->createPresensi($pegawaiId, $shiftId, $tanggal, 'pulang', $jamSekarang, $lat, $lon);
                return $this->sendResponse('Success', 'Absen pulang berhasil', null, 200);
            } else {
                return $this->sendResponse('Failed', 'Anda sudah absen hari ini', null, 400);
            }
        } catch (\Throwable $th) {
            return $this->sendResponse('Failed', 'Sedang tidak bisa absen', null, 500);
        }
    }

    public function createPresensi($pegawaiId, $shiftId, $tanggal, $status, $jam, $lat, $lon)
    {
        $presensi = new Presensi;
        $presensi->pegawai_id = $pegawaiId;
        $presensi->shift_id = $shiftId;
        $presensi->tanggal = $tanggal;
        $presensi->status = $status;
        $presensi->lat = $lat;
        $presensi->lon = $lon;
        if ($status === 'pulang') {
            $shift = Shift::find($shiftId);
            $jamSelesaiShift = Carbon::createFromTimeString($shift->jam_selesai);

            if ($jam < $jamSelesaiShift) {
                // Pulang terlalu cepat
                $presensi->waktu_kecepetan = $this->calculateKecepetan($jam, $jamSelesaiShift);
            }
        } else {
            $presensi->waktu_keterlambatan = $this->calculateKeterlambatan($shiftId, $jam, $status);
        }
        $presensi->save();
    }

    public function calculateKeterlambatan($shiftId, $jam, $status)
    {
        $shift = Shift::find($shiftId);
        $jamMulaiShift = Carbon::createFromTimeString($shift->jam_mulai);

        if ($status === 'datang' && $jam > $jamMulaiShift) {
            return Carbon::parse($jam)->diffInMinutes($jamMulaiShift);
        }

        return null;
    }

    public function calculateKecepetan($jamPulang, $jamSelesaiShift)
    {
        return Carbon::parse($jamPulang)->diffInMinutes($jamSelesaiShift);
    }
}
