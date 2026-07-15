<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model

{
   protected $fillable = ['nama', 'alamat', 'no_hp', 'keluarga_id'];

   public function user()
   {
       return $this->belongsTo(\App\Models\User::class);
   }

   public function keluarga()
   {
       return $this->belongsTo(\App\Models\Keluarga::class, 'keluarga_id');
   }
}

