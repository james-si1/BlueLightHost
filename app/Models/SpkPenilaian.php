<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpkPenilaian extends Model
{
    protected $fillable = [
        'nama_responden',
        'c1',
        'c2',
        'c3',
    ];
}
