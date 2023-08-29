<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $primaryKey = 'dokter_id';
    protected $table = 'dokter';
    protected $guarded = [];

    public function pegawai()
    {
        return $this->belongsTo('App\Pegawai', 'pegawai_id', 'pegawai_id');
    }
}
