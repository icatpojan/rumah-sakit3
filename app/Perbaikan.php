<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    protected $primaryKey = 'perbaikan_id';
    protected $table = 'perbaikan';
    protected $guarded = [];

    public function permohonan_perbaikan()
    {
        return $this->belongsTo(PermohonanPerbaikan::class, 'permohonan_perbaikan_id', 'permohonan_perbaikan_id');
    }
}
