<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incendio extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_inicio',
        'causas_probables',
        'estado',
    ];

    public function comunidadIncendios()
    {
        return $this->hasMany(ComunidadIncendio::class);
    }

}
