<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasienRequest extends FormRequest
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
            'nama_pasien' => 'required|string|max:40',
            'nik' => 'required|string|max:20',
            'jk' => 'nullable|in:L,P',
            'tmp_lahir' => 'nullable|string|max:15',
            'tgl_lahir' => 'nullable|date',
            'nm_ibu' => 'nullable|string|max:40',
            'alamat' => 'nullable|string|max:200',
            'gol_darah' => 'nullable|in:A,B,O,AB,-',
            'pekerjaan' => 'nullable|string|max:60',
            'status' => 'nullable|in:belum menikah,menikah',
            'agama' => 'nullable|string|max:12',
            'tgl_daftar' => 'nullable|date',
            'no_tlp' => 'nullable|string|max:40',
            'umur' => 'nullable|string|max:30',
            'pnd' => 'nullable|in:TS,TK,SD,SMP,SMA,SLTA/SEDERAJAT,D1,D2,D3,D4,S1,S2,S3,-',
            'keluarga' => 'nullable|in:AYAH,IBU,ISTRI,SUAMI,SAUDARA,ANAK',
            'namakeluarga' => 'nullable|string|max:50',
            'penjamin' => 'nullable|string|max:100',
            'no_peserta' => 'nullable|string|max:25',
            'kd_kelurahan' => 'nullable|integer',
            'kd_kec' => 'nullable|integer',
            'kd_kab' => 'nullable|integer',
            'pekerjaanpj' => 'nullable|string|max:35',
            'alamatpj' => 'nullable|string|max:100',
            'kelurahanpj' => 'nullable|string|max:60',
            'kecamatanpj' => 'nullable|string|max:60',
            'kabupatenpj' => 'nullable|string|max:60',
            'perusahaan_pasien' => 'nullable|string|max:8',
            'suku_bangsa' => 'nullable|integer',
            'bahasa_pasien' => 'nullable|integer',
            'cacat_fisik' => 'nullable|integer',
            'email' => 'nullable|email|max:50',
            'nip' => 'nullable|string|max:30',
            'kd_prop' => 'nullable|integer',
            'propinsipj' => 'nullable|string|max:30',
        ];

    }
}
