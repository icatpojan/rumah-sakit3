<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerawatanRequest extends FormRequest
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
            'poliklinik_id' => 'required|integer',
            'nama_perawatan' => 'required|string|max:80',
            'bagian_rs' => 'nullable|numeric',
            'bhp' => 'nullable|numeric',
            'tarif_perujuk' => 'nullable|numeric',
            'tarif_tindakan_dokter' => 'nullable|numeric',
            'tarif_tindakan_petugas' => 'nullable|numeric',
            'kso' => 'nullable|numeric',
            'menejemen' => 'nullable|numeric',
            'total_biaya' => 'nullable|numeric',
            'kode_pj' => 'nullable|string|max:3',
            'status' => 'nullable|in:0,1',
            'kelas' => 'nullable|in:-,Rawat Jalan,Kelas 1,Kelas 2,Kelas 3,Kelas Utama,Kelas VIP,Kelas VVIP',
            'kategori' => 'nullable|in:PK,PA,MB',
        ];
    }
}
