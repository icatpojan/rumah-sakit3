<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $primaryKey = 'barang_id';
    protected $table = 'barang';
    protected $guarded = [];
}
