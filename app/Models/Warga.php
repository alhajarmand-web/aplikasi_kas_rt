<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model

{
   protected $fillable = ['nama', 'alamat', 'no_hp'];
 public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}

