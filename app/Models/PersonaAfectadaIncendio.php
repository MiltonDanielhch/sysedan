<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaAfectadaIncendio extends Model
{
    use HasFactory;

    protected $fillable = [
        'grupo_etario_id',
        'cantidad_afectados_por_incendios',
        'formulario_id',
    ];

    public function grupoEtario()
    {
        return $this->belongsTo(GrupoEtario::class);
    }

    public function formulario()
    {
        return $this->belongsTo(Formulario::class);
    }
}
