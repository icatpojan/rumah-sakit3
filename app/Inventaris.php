<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $primaryKey = 'inventaris_id';
    protected $table = 'inventaris';
    protected $guarded = [];
}
