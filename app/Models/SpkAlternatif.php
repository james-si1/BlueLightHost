<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpkAlternatif extends Model
{
    protected $fillable = [
        'kode',
        'nama_ikan',
        'keterangan',
    ];
}
