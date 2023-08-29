<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $primaryKey = 'detail_id';
    protected $table = 'detail';
    protected $guarded = [];
}
