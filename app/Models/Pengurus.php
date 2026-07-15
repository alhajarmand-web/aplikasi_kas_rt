<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'pengurus';

    protected $fillable = [
        'nama',
        'jabatan',
        'rt_rw',
        'blok',
        'no_hp',
        'status',
        'masa_jabatan',
    ];
}
