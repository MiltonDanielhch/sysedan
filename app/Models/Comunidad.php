<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_comunidad',
        'tipo_comunidad',
        'municipio_id',
    ];

    public function municipio(){
        return $this->belongsTo(Municipio::class);
    }

    public function formularios(){
        return $this->hasMany(Formulario::class);
    }
    public function comunidadIncendios()
    {
        return $this->hasMany(ComunidadIncendio::class);
    }

    public function servicioBasico()
    {
        return $this->belongsTo(ServicioBasico::class);
    }
}
