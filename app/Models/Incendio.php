<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incendio extends Model
{
    use HasFactory;

    public function comunidadIncendios()
    {
        return $this->hasMany(ComunidadIncendio::class);
    }

}
