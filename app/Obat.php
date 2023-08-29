<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $primaryKey = 'obat_id';
    protected $table = 'obat';
    protected $guarded = [];
}
