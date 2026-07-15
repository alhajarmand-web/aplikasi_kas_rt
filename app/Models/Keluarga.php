<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $table = 'keluargas';

    protected $fillable = [
        'nama_keluarga',
        'kepala_keluarga',
        'alamat',
        'rt_rw',
        'blok',
    ];

    public function anggotas()
    {
        return $this->hasMany(\App\Models\Warga::class, 'keluarga_id');
    }
}
