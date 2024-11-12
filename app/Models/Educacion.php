<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Educacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'institucion_id',
        'modalidad_educacion_id',
        'numero_estudiantes',
        'formulario_id',
    ];
    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }

    public function modalidadEducacion()
    {
        return $this->belongsTo(ModalidadEducacion::class);
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}
