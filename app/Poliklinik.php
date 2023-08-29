<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
    protected $primaryKey = 'poliklinik_id';
    protected $table = 'poliklinik';
    protected $guarded = [];
}
