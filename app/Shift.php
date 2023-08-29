<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $primaryKey = 'shift_id';
    protected $table = 'shift';
    protected $guarded = [];
}
