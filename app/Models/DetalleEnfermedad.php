<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEnfermedad extends Model
{
    use HasFactory;

    public function saluds()
    {
        return $this->hasMany(Salud::class);
    }
    // ver
    // public function gruposEtarios()
    // {
    //     return $this->belongsToMany(GrupoEtario::class);
    // }

}
