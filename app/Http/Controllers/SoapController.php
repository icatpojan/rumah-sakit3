<?php

namespace App\Http\Controllers;

use App\Http\Requests\SoapRequest;
use Illuminate\Http\Request;
use App\Soap;

class SoapController extends Controller
{
    // Menampilkan daftar soap
    public function index(Request $request)
    {
        $query = Soap::query();

        if ($request->has('soap_id')) {
            $query->where('soap_id',  $request->input('soap_id'));
        }
        if ($request->has('regristasi_id')) {
            $query->where('regristasi_id',  $request->input('regristasi_id'));
        }

        $soap = $query->get();

        return $this->sendResponse('Success', 'Daftar Soap berhasil diambil', $soap, 200);
    }

    //tambah soap
    public function create(SoapRequest $request)
    {

        $soapData = $request->all();
        $soap = Soap::create($soapData);

        if ($soap) {
            return $this->sendResponse('Success', 'Berhasil tambah soap', $soap, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal menambahkan data Soap', null, 500);
        }
    }

    public function update(SoapRequest $request, $soap_id)
    {
        $soapData = $request->all();
        $soap = Soap::where('soap_id', $soap_id)->update($soapData);

        if ($soap) {
            return $this->sendResponse('Success', 'Berhasil update soap', $soap, 200);
        } else {
            return $this->sendResponse('Error', 'Gagal mengupdate data Soap', null, 500);
        }
    }
}
