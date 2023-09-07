<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermohonanPerbaikan extends Model
{
    protected $primaryKey = 'permohonan_id';
    protected $table = 'permohonan_perbaikan';
    protected $guarded = [];
}
