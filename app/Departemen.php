<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $primaryKey = 'departemen_id';
    protected $table = 'departemen';
    protected $guarded = [];
}
