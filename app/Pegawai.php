<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $primaryKey = 'pegawai_id';
    protected $table = 'pegawai';
    protected $guarded = [];

    public function akun()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }
}
