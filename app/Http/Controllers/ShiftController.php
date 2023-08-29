<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shift;

class ShiftController extends Controller
{
    // Menampilkan daftar shift
    public function index(Request $request)
    {
        $query = Shift::query();

        if ($request->has('nama_shift')) {
            $query->where('nama_shift',  $request->input('nama_shift'));
        }

        if ($request->has('shift_id')) {
            $query->where('shift_id',  $request->input('shift_id'));
        }

        if ($request->has('departemen_id')) {
            $query->where('departemen_id',  $request->input('departemen_id'));
        }

        $shift = $query->get();

        return $this->sendResponse('Success', 'Daftar Shift berhasil diambil', $shift, 200);
    }

    //tambah shift
    public function create(Request $request)
    {
        $this->validate($request, [
            'departemen_id' => 'required|integer',
            'shift_name' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s',
        ]);

        $shiftData = $request->all();
        $shift = Shift::create($shiftData);

        if ($shift) {
            return $this->sendResponse('Success', 'Berhasil tambah shift', $shift, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Shift', null, 500);
        }
    }

    public function update(Request $request, $shift_id)
    {
        $this->validate($request, [
            'departemen_id' => 'required|integer',
            'shift_name' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i:s',
            'jam_selesai' => 'required|date_format:H:i:s',
        ]);

        $shiftData = $request->all();
        $shift = Shift::where('shift_id', $shift_id)->update($shiftData);

        if ($shift) {
            return $this->sendResponse('Success', 'Berhasil update shift', $shift, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Shift', null, 500);
        }
    }
}
