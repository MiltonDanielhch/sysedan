<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoEtario extends Model
{
    use HasFactory;
    public function personaAfectadaIncendios()
    {
        return $this->hasMany(PersonaAfectadaIncendio::class);
    }
    public function saluds()
    {
        return $this->hasMany(Salud::class);
    }
}
