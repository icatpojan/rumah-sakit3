<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $primaryKey = 'pasien_id';
    protected $table = 'pasien';
    protected $guarded = [];

    public function akun()
    {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }
}
