<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perawatan extends Model
{
    protected $primaryKey = 'perawatan_id';
    protected $table = 'perawatan';
    protected $guarded = [];
}
