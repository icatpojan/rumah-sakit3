<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regristasi extends Model
{
    protected $primaryKey = 'regristasi_id';
    protected $table = 'regristasi';
    protected $guarded = [];

    public function detail()
    {
        return $this->hasMany(Detail::class, 'regristasi_id', 'regristasi_id');
    }

    public function detail_obat()
    {
        return $this->hasMany(DetailObat::class, 'regristasi_id', 'regristasi_id');
    }

    public function detail_tambahan()
    {
        return $this->hasMany(DetailTambahan::class, 'regristasi_id', 'regristasi_id');
    }
}
