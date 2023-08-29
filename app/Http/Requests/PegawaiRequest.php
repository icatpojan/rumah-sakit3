<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nik' => 'required|string|max:20',
            'nama_pegawai' => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'tempat_lahir' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:60',
            'photo' => 'nullable|string|max:500',
            'golongan_darah' => 'nullable|in:A,B,O,AB,-',
            'agama' => 'nullable|string|max:12',
            'no_telp' => 'nullable|string|max:13',
            'email' => 'nullable|email',
            'status_nikah' => 'nullable|in:BELUM MENIKAH,MENIKAH,JANDA,DUDHA,JOMBLO',
            'pendidikan_terakhir' => 'nullable|string|max:80',
            'alumni' => 'nullable|string|max:60',
            'bank' => 'nullable|string|max:50',
            'rekening' => 'nullable|string|max:25',
            'status_wajib_pajak' => 'nullable|string|max:5',
            'status_kerja' => 'nullable|string|max:3',
            'status_aktif' => 'nullable|in:AKTIF,CUTI,KELUAR,TENAGA LUAR',
            'npwp' => 'nullable|string|max:15',
            'gaji_pokok' => 'nullable|integer',
            'departemen_id' => 'required|string|max:4',
            'bidang' => 'nullable|string|max:15',
            'jabatan' => 'nullable|string|max:25',
            'jenjang_jabatan' => 'nullable|string|max:5',
            'kode_kelompok' => 'nullable|string|max:3',
            'kode_resiko' => 'nullable|string|max:3',
            'kode_emergency' => 'nullable|string|max:3',
            'mulai_kontrak' => 'nullable|date',
            'mulai_kerja' => 'nullable|date',
            'masa_kerja' => 'nullable|in:<1,PT,FT>1',
            'indexins' => 'nullable|string|max:4',
            'wajibmasuk' => 'nullable|integer',
            'pengurang' => 'nullable|integer',
            'indek' => 'nullable|integer',
            'cuti_diambil' => 'nullable|integer',
            'dankes' => 'nullable|integer',
        ];
    }
}
