<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpkKriteria extends Model
{
    protected $fillable = [
        'kode',
        'nama',
        'tipe',
        'bobot',
    ];
}
