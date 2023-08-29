<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SoapRequest extends FormRequest
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
            'regristasi_id' => 'required|integer',
            'tgl_perawatan' => 'nullable|date',
            'jam_rawat' => 'nullable|date_format:H:i:s',
            'suhu_tubuh' => 'nullable|string|max:5',
            'tensi' => 'required|string|max:8',
            'nadi' => 'nullable|string|max:3',
            'respirasi' => 'nullable|string|max:3',
            'tinggi' => 'nullable|string|max:5',
            'berat' => 'nullable|string|max:5',
            'spo2' => 'nullable|string|max:3',
            'gcs' => 'nullable|string|max:10',
            'kesadaran' => 'nullable|in:Compos Mentis,Somnolence,Sopor,Coma',
            'keluhan' => 'nullable|string|max:2000',
            'pemeriksaan' => 'nullable|string|max:2000',
            'alergi' => 'nullable|string|max:50',
            'lingkar_perut' => 'nullable|string|max:5',
            'rtl' => 'nullable|string|max:2000',
            'penilaian' => 'nullable|string|max:2000',
            'instruksi' => 'nullable|string|max:2000',
            'evaluasi' => 'nullable|string|max:2000',
            'nip' => 'nullable|string|max:20',
        ];

    }
}
