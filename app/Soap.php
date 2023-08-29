<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soap extends Model
{
    protected $primaryKey = 'soap_id';
    protected $table = 'soap';
    protected $guarded = [];
}
