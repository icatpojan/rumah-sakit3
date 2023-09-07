<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemeliharaan extends Model
{

    protected $primaryKey = 'pemeliharaan_id';
    protected $table = 'pemeliharaan';
    protected $guarded = [];
}
