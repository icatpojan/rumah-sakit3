<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $primaryKey = 'kamar_id';
    protected $table = 'kamar';
    protected $guarded = [];
}
