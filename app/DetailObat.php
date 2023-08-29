<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailObat extends Model
{
    protected $primaryKey = 'detail_obat_id';
    protected $table = 'detail_obat';
    protected $guarded = [];
}
