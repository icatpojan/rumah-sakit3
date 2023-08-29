<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $primaryKey = 'presensi_id';
    protected $table = 'presensi';
    protected $guarded = [];
}
