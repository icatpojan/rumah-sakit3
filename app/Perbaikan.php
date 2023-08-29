<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    protected $primaryKey = 'perbaikan_id';
    protected $table = 'perbaikan';
    protected $guarded = [];
}
