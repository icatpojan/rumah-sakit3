<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $primaryKey = 'jadwal_id';
    protected $table = 'jadwal';
    protected $guarded = [];
}
